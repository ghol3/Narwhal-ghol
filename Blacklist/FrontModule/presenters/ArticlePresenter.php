<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 16.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\FrontModule\Presenters
 */

namespace 
    Blacklist\FrontModule\Presenters;

use
    Nette,
    Nette\Database\Context;

/**
 * @author Томас Петр
 */
class ArticlePresenter extends BasePresenter
{
    
    /**
     *
     * @var type 
     */
    private $articleFactory = NULL;
    
    /**
     *
     * @var type 
     */
    private $database = NULL;
    
    /**
     * This is the constructor of this class just set the
     * database context from Nette to my parent.
     * 
     * @param Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
        $this->database = $db;
        parent::__construct($db);
    }
    
    /**
     *
     *
     */
    public function startup()
    {
        parent::startup();
        $this->defaultInit($this->database, $this->template);
        $this->articleFactory = new \Blacklist\Factory\ArticleFactory($this->database);
    }
    
    /**
     * 
     * @param type $url
     */
    public function renderShow($url)
    {
        $this->activePage = 'articles';
        $articleF = new \Blacklist\Factory\ArticleFactory($this->database);
        $this->template->article = $articleF->getByUrl($url);
        
        if($this->template->article->title == NULL){
            $this->redirect('Error:default');
            return;
        }
        
        $this->template->articles = $articleF->getAll(3);
        $this->defaultInit($this->database, $this->template);
        $categoryF = new \Blacklist\Factory\CategoryFactory($this->database);
        $this->template->categories = $categoryF->getAll();
        $this->template->rarticles = $articleF->getAll();
    }
    
    public function renderDefault($link)
    {
        $this->activePage = 'articles';
        $this->template->activePage = 'articles';
        $this->template->link = $link;
        $this->template->articles = $this->articleFactory->getAll(NULL, array('visibility', 1));
    }
    
    
    public function handleScoring($score, $article)
    {
        $artc = $this->articleFactory->getById($article);
        $artc->setDatabase($this->database);
        $artc->evaluate($score);
        
        if($this->isAjax()){
            $this->redrawControl('scoring');
        }
    }
    
    protected function createComponentCommentForm()
    {
        $form = new \Blacklist\Component\Comment\CommentComponentFactory($this->database, $this);
        $article = $this->articleFactory->getByUrl($this->getParameter('url'));
        return $form->getNewArticleCommentForm($article->id, $this->getUser()->id);
    }
}