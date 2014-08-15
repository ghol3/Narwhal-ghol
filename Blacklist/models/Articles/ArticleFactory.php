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
    Nette\Database\Context              as Database,
    Nette\Object                        as NObject,
    Blacklist\Object\ArticleObject      as Article,
    Blacklist\Model\String\TableString  as Tables;

/**
 * This class is used to model the article. 
 * Represents events for classic articles models.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class ArticleFactory extends NObject implements IFactory
{
    
    /** @var \Nette\Database\Context */
    private $database = NULL;
    
    /**
     * database specification
     */
    public function __construct(Database $database)
    {
        $this->database = (object) $database;
    }
    
    /**
     * @param type $id int
     * @return \Blacklist\Object\ArticleObject
     */
    public function getById($id)
    {
        $articleControl = new Article(NULL, NULL, NULL, NULL);
        $articleControl->setDatabase($this->database);
        $articleData = $this->database->table(Tables::ARTICLE)->where('id', $id)->fetch();
        if(isset($articleData->title)){
            $articleControl->make($articleData);
        }
        return $articleControl;
    }
    
    /**
     * @param type $url string
     * @return \Blacklist\Object\ArticleObject
     */
    public function getByUrl($url)
    {
        $articleControl = new Article(NULL, NULL, NULL, NULL);
        $articleControl->setDatabase($this->database);
        $articleData = $this->database->table(Tables::ARTICLE)->where('link', $url)->fetch();
        if(isset($articleData->title)){
            $articleControl->make($articleData);
        }
        return $articleControl;
    }
    
    /**
     * @param type $conditions array
     * @return \Blacklist\Object\ArticleObject
     */
    public function getRowBy($conditions)
    {
        $articleControl = new Article(NULL, NULL, NULL, NULL);
        $articleControl->setDatabase($this->database);
        $articleData = $this->database->table(Tables::ARTICLE)->where($conditions)->fetch();
        if(isset($articleData->title)){
            $articleControl->make($articleData);
        }
        return $articleControl;
    }
    
    /**
     * @param type $conditions array
     * @param type $limit int
     * @return \Blacklist\Object\ArticleObject array
     */
    public function getArrayBy($conditions, $limit = NULL)
    {
        $articles = $this->database->table(Tables::ARTICLE)
            ->where($conditions)
            ->order('priority')
            ->limit($limit);
        
        return $this->getControlArray($articles);
    }
    
    /**
     * @param type $limit int
     * @param type $conditions array
     * @return \Blacklist\Object\ArticleObject array
     */
    public function getAll($limit = NULL, $conditions = NULL)
    {
        $articles = ($conditions === NULL) ? $this->database->table(Tables::ARTICLE)
            ->order('priority')->limit($limit): $this->database->table(Tables::ARTICLE)
            ->where($conditions)
            ->order('priority')
            ->limit($limit);
        
        return $this->getControlArray($articles);
    }

    /**
     * Use only with web pagination
     * @param $limit
     * @param $offset
     * @param $conditions
     * @return Article
     */
    public function getAllOffset($limit, $offset, $conditions)
    {
        $articles = $this->database->table(Tables::ARTICLE)
                ->where($conditions)
                ->order('priority')
                ->limit($limit, $offset);
        
        return $this->getControlArray($articles);
    }
    
    /**
     * @param type $category int
     * @param type $limit int
     * @return \Blacklist\Object\ArticleObject array
     */
    public function getByCategory($category, $limit = NULL)
    {
        $articles = $this->database->table(Tables::ARTICLE)
            ->where('category', $category)
            ->order('priority')
            ->limit($limit);
        
        return $this->getControlArray($articles);
    }
    
    /**
     * @param type $articles array
     * @return \Blacklist\Object\ArticleObject array
     */
    private function getControlArray($articles)
    {
        $aControls = array();
        foreach($articles as $article)
        {
            $control = new Article(NULL, NULL, NULL, NULL);
            $control->setDatabase($this->database);
            if(isset($article->title)){
                $control->make($article);
                $aControls[] = $control;
            }
        }
        return $aControls;
    }
    
    /**
     * 
     * @param type $positions
     */
    public function updateAll($positions)
    {
        foreach($positions as $key => $priority)
        {
            $this->database->table(Tables::ARTICLE)
                ->where('id', $key)
                ->update(array('priority' => $priority));
        }
    }
    
    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct()
    {
        unset($this->database);
    }
}