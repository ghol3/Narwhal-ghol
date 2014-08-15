<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 03.07.2014
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
class CategoryPresenter extends BasePresenter
{

    /**
     * @var \Blacklist\Factory\CategoryFactory|null
     */
    private $categoryFactory = NULL;
    
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
        $this->categoryFactory = new \Blacklist\Factory\CategoryFactory($db);
    }
    
    /**
     *
     *
     */
    public function startup()
    {
        parent::startup();
        $this->defaultInit($this->database, $this->template);
    }
    
    /**
     * 
     * @param type $url
     */
    public function renderShow($url)
    {
        $this->activePage = 'produkty';
        $articleF = new \Blacklist\Factory\ArticleFactory($this->database);
        $this->template->articles = $articleF->getAll(3);
        $this->defaultInit($this->database, $this->template);
        $categoryF = new \Blacklist\Factory\CategoryFactory($this->database);
        $this->template->category = $categoryF->getByUrl($url);
        if($this->template->category->name == NULL){
            $this->redirect('Error:default');
            return;
        }
        $this->template->categories = $categoryF->getAll();
        $this->template->rarticles = $articleF->getAll();
    }
}