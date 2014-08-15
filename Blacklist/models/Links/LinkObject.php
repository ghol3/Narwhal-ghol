<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 30.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace
    Blacklist\Object;

use
    Blacklist\Model\String\TableString as Tables;

class LinkObject extends \Blacklist\Object\Object implements \Blacklist\Object\IObject
{
    public
        /** @var type string */
        $path           = NULL,
        /** @var type string */
        $presenter      = NULL,
        /** @var type string */
        $action         = NULL,
        /** @var type integer */
        $id             = NULL;
    
    public function __construct($path, $presenter, $action)
    {
        $this->path = (string)$path;
        $this->presenter = (string)$presenter;
        $this->action = (string)$action;
        parent::__construct('\Blacklist\Object\LinkObject');
    }
    
    /**
     * 
     */
    public function create() 
    {
        $this->database->table(Tables::LINKS)
            ->insert($this->toArray());
    }

    /**
     * 
     */
    public function remove() 
    {
        $this->database->table(Tables::LINKS)
                ->where('id', $this->id)
                ->delete();
    }

    /**
     * 
     */
    public function update() 
    {
        $this->database->table(Tables::LINKS)
                ->where('id', $this->id)
                ->update($this->toArray());
    }

}
