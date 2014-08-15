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
    Blacklist\Factory\CommentFactory,
    Blacklist\Factory\PageFactory,
    Blacklist\Factory\UserFactory,
    Blacklist\Model\String\TableString as Tables;

/**
 * This class represents one page from the database as
 * such a stupid object. Why this way? Because I love it!
 * Fuck dynamic languages like PHP, I love data types azaza.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class PageObject extends Object implements IObject
{
    public
        /** @var type string */
        $title          = NULL,
        /** @var type string */
        $description    = NULL,
        /** @var type string */
        $content        = NULL,
        /** @var type int */
        $views          = 0,
        /** @var type string */
        $link           = NULL,
        /** @var type int */
        $score          = 0,
        /** @var type boolean */
        $visibility     = 0,
        /** @var type boolean */
        $enableViews    = 1,
        /** @var type boolean */
        $enableScore    = 1,
        /** @var type boolean */
        $enableComments = 1,
        /** @var type int */
        $category       = NULL,
        /** @var type \Nette\Datetime */
        $editDate       = NULL,
        /** @var type int */
        $author         = NULL,
        /** @var type int */
        $id             = NULL,
        /** @var type \Nette\Datetime */
        $createDate     = NULL;
    
    private
        $comments       = NULL,
        $commentFactory = NULL,
        /** @var type int */
        $commentCount   = 0,
        /** @var type \Blacklist\Model\User\UserControl */
        $authorObject   = NULL,
        /** @var type \Blacklist\Model\Category\CategoryControl */
        $categoryObject = NULL,
        $tags           = NULL;
    
    /**
     * Page item specification
     */
    public function __construct($title, $url, $category, $author)
    {
        $this->title	= (string) $title;
        $this->link     = (string) $url;
        $this->category = (int) $category;
        $this->author	= (int) $author;
        parent::__construct('\\Blacklist\Object\PageObject');
    }

    /**
     * 
     */
    public function create($reload = NULL) 
    {
        $link = new LinkObject($this->link, 'Page', 'Show');
        $link->setDatabase($this->database);
        $link->create();
        
        $this->database->table(Tables::PAGE)
            ->insert($this->toArray(array('id')));
        
        if($reload != NULL){
            $factory = new \Blacklist\Factory\PageFactory($this->database);
            $page = $factory->getByUrl($this->link);
            $this->make($page);
        }
    }

    /**
     * 
     */
    public function remove() 
    {
        $link = new \Blacklist\Factory\LinkFactory($this->database);
        $link->getByUrl($this->link)->remove();
        
        $this->removeAllComments($this->id);
        $this->database->table(Tables::PAGE)
            ->where('id', $this->id)->delete();
    }

    /**
     * 
     */
    public function update() 
    {
        $factory = new \Blacklist\Factory\LinkFactory($this->database);
        $pageF = new \Blacklist\Factory\PageFactory($this->database);
        
        $myPage = $pageF->getById($this->id);
        $myLink = $factory->getByUrl($myPage->link);
        $myLink->path = $this->link;
        $myLink->update();
        
        $this->database->table(Tables::PAGE)
            ->where('id', $this->id)
            ->update($this->toArray(array('id')));
    }
    
    /**
     * @param type $id INTEGER(11)
     * @param type $limit INTEGER
     * @return \Blacklist\Model\Comment\CommentControl array
     */
    public function getComments()
    {
        if($this->comments === NULL){
            $this->commentFactory = new CommentFactory($this->database);
            $this->comments = $this->commentFactory->getByPage($this->id);
        }
        return $this->comments;
    }
    
    /**
     * @param type $id INTEGER(11)
     */
    private function removeAllComments($id)
    {
        $factory = new CommentFactory($this->database);
        $comments = $factory->getByPage($id);
        foreach($comments as $comment){
            $comment->setDatabase($this->database);
            $comment->remove();
        }
    }
    
    public function getCommentCount()
    {
        if($this->commentCount === NULL && $this->database)
        {
            $factory = new CommentFactory($this->database);
            $this->commentCount = (count($factory->getByPage($this->id)));
            unset($factory);
        }
        return $this->commentCount;
    }
    
    /**
     * @return type
     */
    public function getAuthorObject()
    {
        if($this->authorObject === NULL && $this->database)
        {
            $factory = new UserFactory($this->database);
            $this->authorObject = $factory->getById($this->author);
            unset($factory);
        }
        return $this->authorObject;
    }
    
    /**
     * @return type
     */
    public function getCategoryObject()
    {
        if($this->categoryObject === NULL && $this->database)
        {
            $factory = new \Blacklist\Factory\CategoryFactory($this->database);
            $this->categoryObject = $factory->getById($this->category);
            unset($factory);
        }
        return $this->categoryObject;
    }
    
    /**
     * @param type $score
     */
    public function evaluate($score)
    {
        if(!$this->isScored())
        {
            $this->database->table('prefix_score')->insert(array(
                'page' => $this->id,
                'address' => $_SERVER['REMOTE_ADDR'],
                'score'   => $score
            ));
        }
    }
    
    public function getScore()
    {
        $scoring = $this->database->table('prefix_score')->where('page', $this->id);
        $total = 0;
        foreach($scoring as $score){
            $total += $score->score;
        }
        return (count($scoring) == 0) ? 0 : ($total / count($scoring));
    }
    
    public function isScored()
    {
        $scoring = $this->database->table('prefix_score')->where(
            array(
                'address'=> $_SERVER['REMOTE_ADDR'], 
                'page' => $this->id
            )
        );
        return (boolean) (count($scoring));
    }
    
    /**
     * 
     * @return \Blacklist\Object\TagObject
     */
    public function getTags()
    {
        if($this->tags === NULL){
            $factory = new \Blacklist\Factory\TagFactory($this->database);
            $this->tags = $factory->getByPage($this->id);
        }
        return $this->tags;
    }
    
    /**
     * 
     */
    public function removeTags()
    {
        foreach($this->getTags() as $tag){
            $tag->setDatabase($this->database);
            $tag->remove();
        }
    }

    /**
     * destroy all instances that are no longer needed
     */
    public function __destruct()
    {
        unset($this->authorObject);
        unset($this->categoryObject);
    }
}