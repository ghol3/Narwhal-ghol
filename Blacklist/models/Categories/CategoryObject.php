<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 12.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Category
 */

namespace 
    Blacklist\Object;

use
    Blacklist\Factory\ArticleFactory    as ArticleF,
    Blacklist\Model\String\TableString  as Tables,
    Blacklist\Factory\CategoryFactory,
    Blacklist\Factory\LinkFactory,
    Blacklist\Factory\PageFactory;

/**
 * This class represents a single category in a database
 * as a cool object.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class CategoryObject extends Object implements IObject
{
    public
        /** @var type string */
        $name           = NULL,
        /** @var type string */
        $description    = NULL,
        /** @var type boolean */
        $visibility     = 0, 
        /** @var type sint */
        $subcategory    = 0,
        /** @var type int */
        $priority       = 0,
        /** @var type string */
        $link           = NULL,
        /** @var type int */
        $id             = '',
        /** @var type timestamp */
        $createDate     = NULL;
    
    private 
        /** @var type int */
        $parent         = NULL,
        /** @var \Blacklist\Object\CategoryObject */
        $parentObject   = NULL,
        /** @var array of \Blacklist\Object\CategoryObject */
        $subcategories  = array(),
        $parentIndex = 0;
    
    /**
     * Category database connection and factory specification
     */
    public function __construct($name)
    {
        $this->name = (string) $name;
        parent::__construct('\Blacklist\Object\CategoryObject');
    }
    
    /**
     * 
     * @param type $parent
     */
    public function setParent($parent)
    {
        $this->parent = ($parent === 0) ? NULL : $parent;
        $this->subcategory = ($this->parent === NULL || (int)$this->parent === 0) ? 0 : 1;
    }
    
    /**
     * 
     * @return type
     */
    public function getParent()
    {
        return (int) $this->parent;
    }
    
    /**
     * save this new object into database
     */
    public function create()
    {
        $link = new LinkObject($this->link, 'Category', 'Show');
        $link->setDatabase($this->database);
        $link->create();
        
        $factory = new CategoryFactory($this->database);
        $this->priority = count($factory->getAll());
        $this->database->table(Tables::CATEGORY)->insert($this->toArray());
        
        if($this->subcategory && $this->parent !== NULL)
        {
            $ctg = $factory->getByUrl($this->link);
            $data = array
            (
                'category' => $ctg->id,
                'parent'   => $this->parent
             );
            $this->database->table(Tables::SUB_CATEGORY)->insert($data);
        }
    }
    
    /**
     * update this object in my database
     */
    public function update()
    {   
        $linkF = new LinkFactory($this->database);
        $factory = new CategoryFactory($this->database);
        
        $myArticle = $factory->getById($this->id);
        $myLink = $linkF->getByUrl($myArticle->link);
        $myLink->path = $this->link;
        $myLink->update();
        
        $oldItem = $factory->getById($this->id);
        // old item is main menu and now submenu?
        if(!$oldItem->subcategory && $this->subcategory && $this->parent !== NULL)
        {
            $data = array
            (
                'parent'     => $this->parent,
                'category'   => $oldItem->id
            );
            $this->database->table(Tables::SUB_CATEGORY)->insert($data);
            $this->database->table(Tables::CATEGORY)->where('id', $this->id)->update(array('subcategory' => 1));
        }
        // old item is submenu and now is main menu?
        else if($oldItem->subcategory && !$this->subcategory)
        {
            $this->database->table(Tables::SUB_CATEGORY)
                ->where('category', $this->id)
                ->delete();
            $this->database->table(Tables::CATEGORY)->where('id', $this->id)->update(array('subcategory' => 0));
        }
        else if($oldItem->subcategory && $this->subcategory && $this->parent !== NULL)
        {
            $this->database->table(Tables::SUB_CATEGORY)
                ->where('category', $this->id)
                ->delete();
            $data = array
            (
                'parent'	=> $this->parent,
                'category'   => $oldItem->id
            );
            $this->database->table(Tables::SUB_CATEGORY)->insert($data);
        }
        
        $this->database->table(Tables::CATEGORY)
            ->where('id', $this->id)
            ->update(array_merge($this->toArray(), array('visibility' => (int)$this->visibility)));
    }
    
    /**
     * remove this object from database and database clean up
     */
    public function remove()
    {
        $link = new LinkFactory($this->database);
        $link->getByUrl($this->link)->remove();
        
        $parents = $this->database->table(Tables::SUB_CATEGORY)
		->where('category', $this->id);
	
	    foreach($parents as $parent)
	    {
	        $this->database->table(Tables::CATEGORY)
		        ->where('id', $parent->category)
		        ->update(array('subcategory' => 0));
	    }
	
	    $this->database->table(Tables::SUB_CATEGORY)
		    ->where('parent', $this->id)->delete();
	
	    $this->database->table(Tables::SUB_CATEGORY)
		    ->where('category', $this->id)->delete();

        # remove articles and pages by category
        $this->removeAllArticles();
        $this->removeAllPages();
        # remove category
        $this->database->table(Tables::CATEGORY)
            ->where('id', $this->id)->delete();
    }

    /**
     * @return CategoryObject|null
     */
    public function getParentObject()
    {
        if($this->parentObject === NULL)
        {
            $parent = $this->database->table(Tables::SUB_CATEGORY)
                    ->where('category', $this->id)->fetch();
            
            if(isset($parent->parent))
            {
                $myParent = $this->database->table(Tables::CATEGORY)
                        ->where('id', $parent->parent)->fetch();
                $object = new CategoryObject(NULL);
                $object->make($myParent);
                $object->setDatabase($this->database);
                $this->parentObject = $object;
            }
            else
            {
                $this->parentObject = new CategoryObject(NULL);
            }
        }
        return $this->parentObject;
    }
    
    /**
     * 
     * @param \Blacklist\Object\CategoryObject $ctg
     */
    public function setSubCategory(CategoryObject $ctg)
    {
        $this->subcategories[] = $ctg;
    }
    
    /**
     * 
     * @return type
     */
    public function getSubCategories()
    {
        return $this->subcategories;
    }
    
    /**
     * 
     * @param type $index
     */
    public function setParentIndex($index)
    {
        $this->parentIndex = $index;
    }
    
    /**
     * 
     * @return type
     */
    public function getParentIndex()
    {
        return $this->parentIndex;
    }
    
    /**
     * 
     * @return type
     */
    public function getAllArticles()
    {
        $factory = new ArticleF($this->database);
        return $factory->getByCategory($this->id);
    }
    
    /**
     * 
     * @return type
     */
    public function getAllPages()
    {
        $factory = new PageF($this->database);
        return $factory->getByCategory($this->id);
    }
    
    /**
     * remove all articles from database by primary key (category)
     */
    private function removeAllArticles()
    {
        $factory = new ArticleF($this->database);
        $articles = $factory->getByCategory($this->id);
        foreach($articles as $article){
            $article->remove();
        }
        unset($factory);
    }
    
    /**
     * remove all pages from database by primary key (category)
     */
    private function removeAllPages()
    {
        $factory = new PageFactory($this->database);
        $pages = $factory->getByCategory($this->id);
        foreach($pages as $page){
            $page->remove();
        }
        unset($factory);
    }
    
    /**
     * memory clean up
     */
    public function __destruct()
    {
        unset($this->parentObject);
        unset($this->subcategories);
        unset($this->database);
    }
}