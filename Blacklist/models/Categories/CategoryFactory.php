<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 19.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Category
 */

namespace 
    Blacklist\Factory;

use
    Nette\Database\Context              as Database,
    Blacklist\Model\String\TableString  as Tables,
    Blacklist\Object\CategoryObject     as Category;

/**
 * This class is used to model the category. 
 * Represents events for classic category model.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class CategoryFactory implements IFactory
{

    private
        /** @var \Nette\Database\Context */
        $database   = NULL,
        /** @var array of \Blacklist\Object\CategoryObject */
        $tree       = array();
    
    /**
     * This is the main constructor of this class just a put
     * database connection into this class like private.
     * 
     * @param \Nette\Database\Context $database
     */
    public function __construct(Database $database)
    {
        $this->database = (object) $database;
    }

    /**
     * 
     * @param type $limit
     * @param type $conditions
     * @return type
     */
    public function getAll($limit = NULL, $conditions = NULL) 
    {
        $categories = ($conditions === NULL) ? $this->database->table(Tables::CATEGORY)
                ->order('priority')
                ->limit($limit): $this->database->table(Tables::CATEGORY)
                ->where($conditions)
                ->order('priority')
                ->limit($limit);
        
        return $this->getControlArray($categories);
    }
    
    /**
     * 
     * @return type
     */
    public function getTree()
    {
        $categories = $this->database->table(Tables::CATEGORY)
                ->where('subcategory', 0)
                ->order('priority');
        $fillCtgs = $this->getControlArray($categories);
        foreach($fillCtgs as $category)
        {
            $category->setParentIndex(0);
            $this->tree[] = $category;
            if(count($category->getSubCategories()) > 0){
                $this->getAllSubCategories($category, 1);
            }
        }
        return $this->tree;
    }

    /***
     * @param $category
     * @param $index
     */
    private function getAllSubCategories($category, $index)
    {
        foreach($category->getSubCategories() as $cat)
        {
            $cat->setParentIndex($index);
            $this->tree[] = $cat;
            $this->getAllSubCategories($cat, ($index + 1));
        }
    }

    /**
     * 
     * @param type $conditions
     * @param type $limit
     * @return type
     */
    public function getArrayBy($conditions, $limit = NULL) 
    {
        $categories = $this->database->table(Tables::CATEGORY)
            ->where($conditions)
            ->order('priority')
            ->limit($limit);

        return $this->getControlArray($categories);
    }

    /**
     * 
     * @param type $id
     * @return \Blacklist\Object\CategoryObject
     */
    public function getById($id) 
    {
        $categoryObject = new Category(NULL);
        $categoryObject->setDatabase($this->database);
        $categoryData = $this->database->table(Tables::CATEGORY)->where('id', $id)->fetch();
        if(isset($categoryData->name)){
            $categoryObject->make($categoryData);
        }
        return $categoryObject;
    }

    /**
     * @param $url
     * @return Category
     */
    public function getByUrl($url)
    {
        $categoryObject = new Category(NULL);
        $categoryObject->setDatabase($this->database);
        $category = $this->database->table(Tables::CATEGORY)->where('link', $url)->fetch();
        if(isset($category->name)){
            $categoryObject->make($category);
        } 
        return $categoryObject;
    }

    /**
     * 
     * @param type $conditions
     * @return \Blacklist\Object\CategoryObject
     */
    public function getRowBy($conditions) 
    {
        $categoryObject = new Category(NULL);
        $categoryObject->setDatabase($this->database);
        $categoryData = $this->database->table(Tables::CATEGORY)->where($conditions)->fetch();
        if(isset($categoryData->name)){
            $categoryObject->make($categoryData);
        }
        return $categoryObject;
    }
    
    /**
     * 
     * @param type $categories
     * @return \Blacklist\Object\CategoryObject
     */
    private function getControlArray($categories)
    {
        $aControls = array();
        foreach($categories as $category)
        {
            $control = new Category(NULL);
            $control->setDatabase($this->database);
            if(isset($category->name))
            {
                $control->make($category);
                $this->fillSubItems($control);
                $aControls[] = $control;
            }
        }
        return $aControls;
    }

    /**
     * @param Category $item
     */
    private function fillSubItems(Category $item)
    {
        // getting submenus for this menu
        $submenus = $this->database->table(Tables::SUB_CATEGORY)
            ->where('parent', $item->id);
        // add submenu into my menu
        foreach($submenus as $submenu)
        {
            $mItem = $this->database->table(Tables::CATEGORY)
                ->get($submenu->category);
            
            $myItem = new Category(NULL);
            $myItem->make($mItem);
            $myItem->setDatabase($this->database);
            $item->setSubCategory($myItem);
        }
        // recursive searching for submenu -> submenu ^^
        foreach($item->getSubCategories() as $subItem)
        {
            $this->fillSubItems($subItem);
        }
    }
    
    /**
     * 
     * @param type $priority
     * @param type $visibility
     * @param type $parent
     */
    public function updateAll($priority, $visibility, $parent)
    {
        foreach($priority as $key => $value)
        {
            $this->database->table(Tables::CATEGORY)
                ->where('id', $key)
                ->update(array('priority' => $value, 'visibility' => (isset($visibility[$key]) && $visibility[$key]) ? 1 : 0));
        }
        
        foreach($parent as $key => $value)
        {
            $this->database->table(Tables::SUB_CATEGORY)
                ->where('category', $key)
                ->delete();
            
            if($value !== '' || $value != 0)
            {
                $this->database->table(Tables::SUB_CATEGORY)
                    ->insert(array('category' => $key, 'parent' => $value));
                $this->database->table(Tables::CATEGORY)
                    ->where('id', $key)
                    ->update(array('subcategory' => 1));
            }
            else
            {
                $this->database->table(Tables::CATEGORY)
                    ->where('id', $key)
                    ->update(array('subcategory' => 0));
            }
        }
    }

    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct()
    {
        unset
        (
            $this->database,
            $this->article,
            $this->page,
            $this->tree
        );
    }
}