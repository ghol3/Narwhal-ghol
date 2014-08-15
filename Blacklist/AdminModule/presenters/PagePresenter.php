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
    Blacklist\Factory\PageFactory,
    Blacklist\Object\PageObject,
    Blacklist\Component\Page\PageComponentFactory;

/**
 * @author Томас Петр
 */
class PagePresenter extends BasePresenter
{   
    
    private $pages = NULL;
    
    private $component = NULL;
    
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
	$this->pages = new PageFactory($db);
	$this->component = new PageComponentFactory($db, $this);
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
    
    protected function createComponentEditform()
    {
	return $this->component->getEditPageForm(
	    $this->getParameter('id')
	);
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
	$this->template->pages = $this->pages->getAll();
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderEdit($id)
    {
	$this->template->page = $this->pages->getById($id);
    }
    
    /**
     * 
     */
    public function renderAdd()
    {
	
    }
    
    /**
     * 
     */
    protected function createComponentAddform()
    {
	return $this->component->getNewPageForm();
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
	$page = $this->pages->getById($id);
        $page->remove();
    }
}