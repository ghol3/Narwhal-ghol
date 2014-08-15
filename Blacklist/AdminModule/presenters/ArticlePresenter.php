<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 03.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\AdminModule\Presenters
 */

namespace 
    Blacklist\AdminModule\Presenters;

use
    Nette,
    Nette\Database\Context,
    Blacklist\Component\User\UserComponentFactory,
    Blacklist\Component\Article\ArticleComponentFactory,
    Blacklist\Factory\CommentFactory,
    Blacklist\Factory\ArticleFactory as AF,
    Blacklist\Factory\CategoryFactory;

/**
 * @author Томас Петр
 */
class ArticlePresenter extends BasePresenter
{
    /**
     *
     * @var type 
     */
    private $fArticle = NULL;
    
    /**
     *
     * @var type 
     */
    private $aComments = NULL;
    
    /**
     *
     * @var type 
     */
    private $component = NULL;
    
    /**
     *
     * @var type 
     */
    private $categories = NULL;
    
    /**
     *
     * @var type 
     */
    private $database;
    
    
    /**
     * This is the constructor of this class just set the
     * database context from Nette to my parent.
     * 
     * @param Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
        parent::__construct();
        $this->database = $db; 
        $this->fArticle = new AF($db);
        $this->aComments = new CommentFactory($db);
        $this->component = new ArticleComponentFactory($db, $this);
        $this->categories = new CategoryFactory($db);
    }
    
    /**
     *
     *
     */
    public function startup()
    {
        parent::startup();
        $this->template->user = $this->getUser();
    }
    
    /**
     * 
     */
    protected function createComponentEditform()
    {
        return $this->component->getEditArticleForm($this->getParameter('id'));
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
        $filter = $this->getParameter('filter');
        $search = $this->getParameter('search');
        $this->template->articles = $this->fArticle->getAll();
        
        $this->template->filter = $filter;
        $this->template->search = $search;
	
        $this->template->totalCount = count($this->fArticle->getAll());
        $this->template->publishCount = 1;
        $this->template->conceptCount = 1;
        $this->template->categories = $this->categories->getAll();
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderEdit($id)
    {
        $this->template->article = $this->fArticle->getById($id);
    }
    
    /**
     * 
     */
    public function renderAdd()
    {
	
    }
    
    /**
     * 
     * @return type
     */
    protected function createComponentAddform()
    {
        return $this->component->getNewArticleForm($this->getUser()->getId());
    }
    
    /**
     * 
     */
    public function renderUpdateAll()
    {   
        $this->fArticle->updateAll($_POST['position']);
        $this->flashMessage(STR_433, 'success');
        $this->redirect('Article:default');
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
        $article = $this->fArticle->getById($id);
        $article->remove();
        $this->flashMessage(STR_434 . ' "' . $article->title . '" ' . STR_435, 'success');
        $this->redirect('Article:default');
    }
}