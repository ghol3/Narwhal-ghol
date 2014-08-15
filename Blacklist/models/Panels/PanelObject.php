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

/**
 * This class represents one panel from the database as
 * such a stupid object. Why this way? Because I love it!
 * Fuck dynamic languages like PHP, I love data types azaza.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class PanelObject extends Object implements IObject
{
    
    public
        /** @var type char */ 
        $position       = 'r',
        /** @var type string */
        $name           = NULL,
        /** @var type string */
        $icon           = NULL,
        /** @var type string */
        $content        = NULL,
        /** @var type timestamp */
        $date           = NULL,
        /** @var type int */
        $priority       = 0,
        /** @var type boolean */
        $visibility     = 0,
        /** @var type int */
        $id             = NULL;
    
    /**
     * Panel specification
     */
    public function __construct($name) 
    {
        $this->name = (string) $name;
        parent::__construct('\\Blacklist\Object\PanelObject');
    }
    
    /**
     * This method create any page by page package model.
     * 
     * @param \Blacklist\Model\Page\PageControl $page
     */
    public function create() 
    {
        $this->database->table(Tables::PANEL)
            ->insert($this->toArray());
    }
    
    /**
     * This method update any page by page model
     * using getId() method.
     * 
     * @param \Blacklist\Model\Page\PageControl $page
     */
    public function update() 
    {
        $this->database->table(Tables::PANEL)
            ->where('id', $this->id)
            ->update($this->toArray());
    }

    /**
     * This method just remove any page by primary key.
     * 
     * @param type $id int(11) (not null, primary key)
     */
    public function remove() 
    {
        $this->database->table(Tables::PANEL)
            ->where('id', $this->id)->delete();
    }
    
    public function getPosition()
    {
        $pos = '';
        if($this->position == 'R'){
            $pos = 'right';
        }else if($this->position == 'L'){
            $pos = 'left';
        }else if($this->position == 'B'){
            $pos = 'bottom';
        }else{
            $pos = 'top';
        }
        return $pos;
    }
    
}