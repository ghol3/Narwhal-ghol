<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 07.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Factory
 */

namespace 
    Blacklist\Factory;

use
    Nette\Database\Context,
    Blacklist\Object\CommentObject,
    Blacklist\Model\String\TableString as Tables;

/**
 * This class is used to model the comment. 
 * Represents events for classic comment model.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class CommentFactory
{
    /**
     * This is the database connection by Nette Framework.
     * 
     * @var \Nette\Database\Context
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
        $this->database = (object) $db;
    }
    
    /**
     * This method returns comment by primary key.
     * 
     * @param type $id INTEGER(11)
     * @return \Blacklist\Object\CommentObject
     */
    public function getById($id)
    {
        $dbComment = $this->database->table(Tables::COMMENT)->get($id);
        $comment = new CommentObject(NULL);
        $comment->make($dbComment);
        $comment->setDatabase($this->database);
        return $comment;
    }

    /**
     * This method returns all comments (or with limit) by article
     * primary key.
     *
     * @param $article integer
     * @param null $limit integer
     * @return \Blacklist\Object\CommentObject array
     */
    public function getByArticle($article, $limit = NULL)
    {
        $comments = $this->database->table(Tables::COMMENT)
            ->where('article', $article)
            ->limit($limit);
        $aComments = array();
        foreach($comments as $comment)
        {
            $commentObject = new CommentObject(NULL);
            $commentObject->make($comment);
            $commentObject->setDatabase($this->database);
            $aComments[] = $commentObject;
        }
        return $aComments;
    }
    
    /**
     * 
     * @param type $article
     * @return type
     */
    public function getByArticleCount($article)
    {
	    return (count($this->database->table(Tables::COMMENT)
		    ->where('article', $article)));
    }
    
    /**
     * 
     * @param type $page
     * @return type
     */
    public function getByPageCount($page)
    {
	    return (count($this->database->table(Tables::COMMENT)
		    ->where('page', $page)));
    }

    /**
     * This method returns all comments (or with limit) by page
     * primary key.
     *
     * @param $page integer (page primary key)
     * @param null $limit integer
     * @return \Blacklist\Object\CommentObject array
     */
    public function getByPage($page, $limit = NULL)
    {
        $comments = $this->database->table(Tables::COMMENT)
            ->where('page', $page)
            ->limit($limit);
        $aComments = array();
        foreach($comments as $comment)
        {
            $commentObject = new CommentObject(NULL);
            $commentObject->make($comment);
            $aComments[] = $commentObject;
        }
        return $aComments;
    }
    
    /**
     * @return type
     */
    public function getAll()
    {
        $comments = $this->database->table(Tables::COMMENT);
        $controls = array();
        foreach($comments as $comment)
        {
            $commentObject = new CommentObject($this->database);
            $commentObject->make($comment);
            $commentObject->setDatabase($this->database);
            $controls[] = $commentObject;
        }
        return $controls;
    }
    
    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct()
    {
        unset($this->database);
    }
}