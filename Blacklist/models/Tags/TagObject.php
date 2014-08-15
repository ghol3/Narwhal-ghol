<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 23.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace
    Blacklist\Object;

class TagObject extends Object implements IObject
{
    public 
        /** */
        $id         = NULL,
        $article    = NULL,
        $page       = NULL,
        $tag        = NULL;
    
    /**
     * 
     * @param type $tag
     */
    public function __construct($tag)
    {
        parent::__construct('\\Blacklist\Object\TagObject');
        $this->tag = (string) $tag;
    }

    /**
     * 
     */
    public function create() 
    {
        $this->database->table('prefix_tags')
                ->insert($this->toArray(array('id')));
    }

    /**
     * 
     */
    public function remove() 
    {
        $this->database->table('prefix_tags')
                ->where('id', $this->id)
                ->delete();
    }

    /**
     * 
     */
    public function update() 
    {
        $this->database->table('prefix_tags')
                ->where('id', $this->id)
                ->update($this->toArray('id'));
    }
}



