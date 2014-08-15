<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 13.07.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace
    Blacklist\Object;

use
    Blacklist\Model\String\TableString as Tables;

class WidgetFactory
{
    /**
     * instance of database connection
     * @var type \Nette\Database\Context
     */
    private $database = NULL;
    
    /**
     * 
     * @param \Nette\Database\Context $db
     */
    public function __construct(\Nette\Database\Context $db)
    {
        $this->database = $db;
    }
    
    /**
     * 
     * @return \Blacklist\Object\WidgetObject
     */
    public function getAll($admin = false)
    {
        if($admin == false){
        $widgets = $this->database->table(Tables::WIDGETS)
                ->where('visibility', '1')
                ->order('priority');
        }else{
            $widgets = $this->database->table(Tables::WIDGETS)
                    ->order('priority');
        }
        $widgetObjects = array();
        foreach($widgets as $widget)
        {
            $wo = new WidgetObject(NULL, NULL);
            $wo->make($widget);
            $wo->setDatabase($this->database);
            $widgetObjects[] = $wo;
        }
        return $widgetObjects;
    }
    
    /**
     * 
     * @param type $name
     * @return \Blacklist\Object\WidgetObject
     */
    public function getByName($name)
    {
        $widget = $this->database->table(Tables::WIDGETS)
                ->where('name', $name)->fetch();
        $wo = new WidgetObject(NULL, NULL);
        $wo->make($widget);
        $wo->setDatabase($this->database);
        return $wo;
    }
    
    /**
     * 
     * @param type $id
     * @return \Blacklist\Object\WidgetObject
     */
    public function getById($id)
    {
        $widget = $this->database->table(Tables::WIDGETS)
                ->where('id', $id)->fetch();
        $wo = new WidgetObject(NULL, NULL);
        $wo->make($widget);
        $wo->setDatabase($this->database);
        return $wo;
    }
}
