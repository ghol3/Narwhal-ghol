<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 07.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace 
    Blacklist\Object;

use
    Nette\Utils\Strings                 as NString,
    Blacklist\Factory\UserFactory       as UserF,
    Blacklist\Factory\CategoryFactory   as CategoryF,
    Blacklist\Factory\CommentFactory    as CommentF,
    Blacklist\Model\String\TableString  as Tables,
    Blacklist\Factory\ArticleFactory,
    Blacklist\Factory\LinkFactory,
    Blacklist\Factory\TagFactory;

/**
 * This class represents a single article in a database
 * as a cool object.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class ArticleObject extends Object implements IObject
{
    public
        /** @var type string */    
        $title          = NULL,
        /** @var type string */    
        $description    = NULL,
        /** @var type string */    
        $content        = NULL,
        /** @var type string */    
        $image          = NULL,
        /** @var type string */    
        $link           = NULL,
        /** @var type integer */    
        $views           = 0,
        /** @var type integer */    
        $score           = 0,
        /** @var type boolean */    
        $enableViews     = 1,
        /** @var type boolean */    
        $enableScore     = 1,
        /** @var type boolean */    
        $enableComments  = 1,
        /** @var type boolean */    
        $visibility      = 0,
        /** @var type integer */    
        $category       = NULL,
        /** @var type integer */    
        $author         = NULL,
        /** @var type integer */    
        $id             = NULL,
        /** @var type timestamp */    
        $createDate     = NULL,
        /** @var type timestamp */    
        $editDate       = NULL,
        /** @var type integer */
        $priority       = NULL;
    
    private
        /** @var \Blacklist\Object\CategoryObject */
        $categoryObject = NULL,
        /** @var \Blacklist\Object\AuthorObject */
        $authorObject   = NULL,
        /** @var array of \Blacklist\Object\CommentObject */
        $comments       = NULL,
        /** @var \Blacklist\Factory\CommentFactory */
        $commentFactory = NULL,
        /** @var type array of strings */
        $tags           = NULL;
    
    /**
     * Article specification
     * 
     * @param type $title string
     * @param type $link string
     * @param type $category int
     * @param type $author int
     */
    public function __construct($title, $link, $category, $author)    
    {
        $this->title        = (string) $title;
        $this->link         = NString::webalize((string)$link);
        $this->category     = (int) $category;
        $this->author       = (int) $author;
        parent::__construct('\Blacklist\Object\ArticleObject');
    }
    
    /**
     * create object in my database
     */
    public function create($reload = NULL)
    {
        $link = new LinkObject($this->link, 'Article', 'Show');
        $link->setDatabase($this->database);
        $link->create();
        
        $this->database->table(Tables::ARTICLE)
            ->insert($this->toArray());
        
        if($reload != NULL){
            $factory = new ArticleFactory($this->database);
            $article = $factory->getByUrl($this->link);
            $this->make($article);
        }
    }
    
    /**
     * update object in my database
     */
    public function update()
    {
        $factory = new LinkFactory($this->database);
        $articleF = new ArticleFactory($this->database);
        
        $myArticle = $articleF->getById($this->id);
        $myLink = $factory->getByUrl($myArticle->link);
        $myLink->path = $this->link;
        $myLink->update();
        
        $this->database->table(Tables::ARTICLE)
            ->where('id', $this->id)
            ->update($this->toArray());
    }
    
    /**
     * remove object in my database by parimary key
     * and data cleansing
     */
    public function remove()
    {
        $this->removeTags();
        foreach($this->getComments() as $comment){
            $comment->remove();
        }
        
        $link = new LinkFactory($this->database);
        $link->getByUrl($this->link)->remove();

        $this->database->table(Tables::ARTICLE)
            ->where('id', $this->id)
            ->delete();
    }
    
    /**
     * @return int
     */
    public function getCommentCount()
    {
        if($this->comments === NULL)
        {
            $commentF = new CommentF($this->database);
            $this->comments = $commentF->getByArticle($this->id);
            unset($commentF);
        }
        return (count($this->comments));
    }
    
    /**
     * @return \Blacklist\Object\CommentObject array
     */
    public function getComments()
    {
        if($this->comments === NULL){
            $this->commentFactory = new CommentF($this->database);
            $this->comments = $this->commentFactory->getByArticle($this->id);
        }
        return $this->comments;
    }
    
    /**
     * @return \Blacklist\Object\Category
     */
    public function getCategoryObject()
    {
        if($this->categoryObject === NULL)
        {
            $factory = new CategoryF($this->database);
            $this->categoryObject = $factory->getById($this->category);
        }
        return $this->categoryObject;
    }
    
    /**
     * @return \Blacklist\Object\UserObject
     */
    public function getAuthorObject()
    {
        if($this->authorObject === NULL)
        {
            $factory = new UserF($this->database);
            $this->authorObject = $factory->getById($this->author);
        }
        return $this->authorObject;
    }
    
    /**
     * @param type $score
     */
    public function evaluate($score)
    {
        if(!$this->isScored())
        {
            $this->database->table(Tables::SCORE)->insert(array(
                'article' => $this->id,
                'address' => $_SERVER['REMOTE_ADDR'],
                'score'   => $score
            ));
        }
    }

    /**
     * @return float|int
     */
    public function getScore()
    {
        $scoring = $this->database->table(Tables::SCORE)->where('article', $this->id);
        $total = 0;
        foreach($scoring as $score){
            $total += $score->score;
        }
        return (count($scoring) == 0) ? 0 : ($total / count($scoring));
    }

    /**
     * @return bool
     */
    public function isScored()
    {
        $scoring = $this->database->table(Tables::SCORE)->where(
            array(
                'address'   => $_SERVER['REMOTE_ADDR'], 
                'article'   => $this->id
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
            $factory = new TagFactory($this->database);
            $this->tags = $factory->getByArticle($this->id);
        }
        return $this->tags;
    }
    
    /**
     * this method remove all tags from article
     */
    public function removeTags()
    {
        foreach($this->getTags() as $tag)
        {
            $tag->setDatabase($this->database);
            $tag->remove();
        }
    }
    
    /**
     * memory clean up
     */
    public function __destruct()
    {
        unset
        (
            $this->database,
            $this->categoryObject,
            $this->authorObject,
            $this->commentFactory,
            $this->comments
        );
    }
}