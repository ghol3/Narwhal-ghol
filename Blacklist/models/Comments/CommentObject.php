<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 08.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace 
    Blacklist\Object;

use
    Blacklist\Model\String\TableString as Tables,
    Blacklist\Factory\UserFactory,
    Blacklist\Factory\ArticleFactory,
    Blacklist\Factory\PageFactory;

/**
 * This class represents one comment from the database as
 * such a stupid object. Why this way? Because I love it!
 * Fuck dynamic languages like PHP, I love data types azaza.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class CommentObject extends Object implements IObject
{
    
    public
        /** @var type integer */
        $status         = 0,
        /** @var type string */
        $content        = NULL,
        /** @var type integer */
        $article        = NULL,
        /** @var type integer */
        $page           = NULL,
        /** @var type integer */
        $author         = NULL,
        /** @var type integer */
        $id             = NULL,
        /** @var type timestamp */
        $date           = NULL,
        /** @var type integer */
        $reaction       = NULL;
    
    private
        /** @var \Blacklist\Object\UserObject */
        $authorObject   = NULL,
        /** @var \Blacklist\Object\ArticleObject */
        $articleObject  = NULL,
        /** @var \Blacklist\Object\PageObject */
        $pageObject     = NULL,
        /** @var \Blacklist\Object\CategoryObject */
        $reactionObject = NULL;
    
    /**
     * Comment specification
     */
    public function __construct($content, $author = NULL, $article = NULL, 
	    $page = NULL)
    {
        $this->content	= (string) $content;
        $this->article	= ($article === NULL) ? $article : (int) $article;
        $this->page     = ($page === NULL) ? $page : (int) $page;
        $this->author	= ($author === NULL) ? $author : (int) $author;
        parent::__construct('\Blacklist\Object\CommentObject');
    }

    /**
     * This method add a new comment into database.
     */
    public function create() 
    {
        if($this->author === 0){
            $this->author = NULL;
        }
        $this->database->table(Tables::COMMENT)
            ->insert($this->toArray());
    }

    /**
     * This method just edit internal comment.
     */
    public function update() 
    {
        $this->database->table(Tables::COMMENT)
            ->where('id', $this->id)
            ->update($this->toArray());
    }

    /**
     * This method remove internal comment object (this object)
     * from the database.
     */
    public function remove() 
    {
        $this->database->table(Tables::COMMENT)
            ->where('id', $this->id)->delete();
    }
    
    /**
     * 
     * @return type
     */
    public function getAuthorObject()
    {
        if($this->authorObject === NULL)
        {
            $factory = new UserFactory($this->database);
            $this->authorObject = $factory->getById($this->id);
        }
        return $this->authorObject;
    }
    
    /**
     * 
     * @return type
     */
    public function getArticleObject()
    {
        if($this->articleObject === NULL)
        {
            $factory = new ArticleFactory($this->database);
            $this->articleObject = $factory->getById($this->article);
        }
        return $this->articleObject;
    }
    
    /**
     * 
     * @return type
     */
    public function getPageObject()
    {
        if($this->pageObject === NULL)
        {
            $factory = new PageFactory($this->database);
            $this->pageObject = $factory->getById($this->page);
        }
        return $this->pageObject;
    }
    
    /**
     * 
     */
    public function getReactionObject()
    {
       if($this->reactionObject === NULL)
       {
           $factory = new CommentObject($this->database);
           $this->reactionObject = $factory->getById($this->reaction);
       }
       return $this->reactionObject;
    }
    
    /**
     * destroy all instances that are no longer needed
     */
    public function __destruct()
    {
        unset($this->reaction);
        unset($this->authorObject);
        unset($this->articleObject);
        unset($this->pageObject);
    }
}