<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 19.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Factory
 */

namespace 
    Blacklist\Factory;

use
    Nette\Database\Context,
    Blacklist\Object\PageObject,
    Blacklist\Model\String\TableString as Tables;

/**
 * This class is used to model the page. 
 * Represents events for classic page model.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class PageFactory
{
    /**
     * This is the database connection by Nette Framework.
     * 
     * @var type \Nette\Database\Context 
     */
    private $database = NULL;
    
    /**
     * This is the main constructor of this class just a put
     * database connection into this class like private.
     * 
     * @param \Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
        $this->database = $db;
    }
    
    /**
     * This method returns any page (just one) by primary key. 
     * (Make a new instance of page model and return it.)
     * 
     * @param type $id int(11) (not null, primary key)
     * @return \Blacklist\Model\Page\PageControl
     */
    public function getById($id)
    {
        $dbPage = $this->database->table(Tables::PAGE)->where('id', $id)->fetch();
        $object = new PageObject(NULL, NULL, NULL, NULL);
        $object->setDatabase($this->database);
        if(isset($dbPage->title)){
            $object->make($dbPage);
        }
        return $object;
    }
    
    /**
     * This method returns just one page too by primary key.
     * (Make a new instance of page model and return it.)
     * 
     * @param type $url varchar(255) (not null)
     * @return \Blacklist\Model\Page\ArticleControl
     */
    public function getByUrl($url)
    {
        $page = $this->database->table(Tables::PAGE)
            ->where('link', $url)->fetch();
        $object = new PageObject(NULL, NULL, NULL, NULL);
        $object->setDatabase($this->database);
        if(isset($page->title)){
            $object->make($page);
        }
        return $object;
    }
    
    /**
     * This method returns all pages like model objects.
     * (Using just for administration cause we don`t want
     * visible pages... for this question is easy answer)
     * -> getVisibleCollection() 
     * 
     * @return \Blacklist\Model\Page\PageControl
     */
    public function getAll()    
    {
        $pages = $this->database->table(Tables::PAGE)
            ->order('createDate DESC');
        $aControls = array();
        foreach($pages as $page)
        {
            $object = new PageObject(NULL, NULL, NULL, NULL);
            $object->setDatabase($this->database);
            if(isset($page->title)){
                $object->make($page);
                $aControls[] = $object;
            }
        }
        return $aControls;
    }
    
    /**
     * This method returns all pages like model objects 
     * from database by category primary key.
     * 
     * @param type $category INTEGER(11)
     * @return \Blacklist\Model\Page\PageControl
     */
    public function getByCategory($category)
    {
        $pages = $this->database->table(Tables::PAGE)
            ->where('category', $category);
        $aControls = array();
        foreach($pages as $page)
        {
            $object = new PageObject(NULL, NULL, NULL, NULL);
            $object->setDatabase($this->database);
            if(isset($page->title)){
                $object->make($page);
                $aControls[] = $object;
            }
        }
        return $aControls;
    }
    
    /**
     * This method returns all pages like model objects 
     * from database but just where visibility is enabled.
     * 
     * @return \Blacklist\Model\Page\PageControl
     */
    public function getVisible()
    {
        $pages = $this->database->table(Tables::PAGE)
            ->where('visible', '1')->order('createDate DESC');
        $aControls = array();
        foreach($pages as $page)
        {
            $object = new PageObject(NULL, NULL, NULL, NULL);
            $object->setDatabase($this->database);
            if(isset($page->title)){
                $object->make($page);
                $aControls[] = $object;
            }
        }
        return $aControls;
    }
    
    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct()
    {
        unset($this->database);
    }
}