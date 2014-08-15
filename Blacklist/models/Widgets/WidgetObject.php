<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 05.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Panel
 */

namespace
    Blacklist\Object;

use
    Blacklist\Model\String\TableString as Tables;

class WidgetObject extends \Blacklist\Object\Object implements \Blacklist\Object\IObject
{
    public
        /** @var type int */
        $id         = NULL,
        /** @var type string */
        $name       = NULL,
        /** @var type string */
        $content    = NULL,
        /** @var type int */
        $priority   = NULL,
        /** @var type int */
        $visibility = NULL,
        /** @var type int */
        $user       = NULL,
        $class, $type;
    
    /**
     * 
     * @param type $name
     * @param type $content
     */
    public function __construct($name, $content)
    {
        $this->name = (string) $name;
        $this->content = (string) $content;
        parent::__construct('\Blacklist\Object\WidgetObject');
    }

    /**
     * 
     * @return type
     */
    public function getUserObject()
    {
        $userF = new \Blacklist\Factory\UserFactory($this->database);
        return $userF->getById($this->user);
    }
    
    /**
     * 
     */
    public function create() 
    {
       $this->database->table(Tables::WIDGETS)
               ->insert($this->toArray());
    }

    /**
     * 
     */
    public function remove() 
    {
        $this->database->table(Tables::WIDGETS)
                ->where('id', $this->id)
                ->delete();
    }

    /**
     * 
     */
    public function update() 
    {
        $this->database->table(Tables::WIDGETS)
                ->where('id', $this->id)
                ->update($this->toArray());
    }
}
