<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 21.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace
    Blacklist\Object;

use
    Blacklist\Model\String\TableString as Tables;

/**
 * @author Томас Петр <www.beepvix.com>
 */
class ModuleObject extends Object implements IObject
{
    public 
        /** @var type string */
        $name          = NULL,
        /** @var type string */
        $date          = NULL,
        /** @var type string */
        $author        = NULL,
        /** @var type string */
        $description   = NULL,
        /** @var type string */
        $version       = NULL,
        /** @var type string */
        $active        = NULL,
        /** @var type int */
        $id            = NULL,
        $key            = NULL;
    
    /**
     * Page item specification
     */
    public function __construct($name, $author, $version)
    {
        $this->name = (string) $name;
        $this->author = (string) $author;
        $this->version = (string) $version;
        parent::__construct('\\Blacklist\Object\ModuleObject');
    }

    /**
     * 
     */
    public function create() 
    {
        $this->database->table(Tables::MODULES)
            ->insert($this->toArray(array('id')));
    }

    /**
     * 
     */
    public function remove() 
    {
        $this->database->table(Tables::MODULES)
            ->where('id', $this->id)->delete();
    }

    /**
     * 
     */
    public function update() 
    {
        $this->database->table(Tables::MODULES)
            ->where('id', $this->id)
            ->update($this->toArray(array('id')));
    }
}