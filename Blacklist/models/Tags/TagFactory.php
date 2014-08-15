<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 23.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Factory
 */

namespace
    Blacklist\Factory;

class TagFactory
{
    private $database;
    
    public function __construct(\Nette\Database\Context $db)
    {
        $this->database = $db;
    }
    
    public function getByArticle($articleId)
    {
        $array = array();
        $tagDB = $this->database->table('prefix_tags')->where('article', $articleId);
        foreach($tagDB as $tag)
        {
            $tagObject = new \Blacklist\Object\TagObject(NULL);
            $tagObject->make($tag);
            $array[] = $tagObject;
        }
        return $array;
    }
    
    public function getByPage($pageId)
    {
        $array = array();
        $tagDB = $this->database->table('prefix_tags')->where('page', $pageId);
        foreach($tagDB as $tag)
        {
            $tagObject = new \Blacklist\Object\TagObject(NULL);
            $tagObject->make($tag);
            $array[] = $tagObject;
        }
        return $array;
    }
}
