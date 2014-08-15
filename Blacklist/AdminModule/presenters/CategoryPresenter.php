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
    Blacklist\Model\Category\CategoryAction,
    Blacklist\Component\Category\CategoryComponentFactory;

/**
 * @author Томас Петр
 */
class CategoryPresenter extends BasePresenter
{   
    /**
     *
     * @var type 
     */
    private $categories = NULL;
    
    /**
     *
     * @var type 
     */
    private $component = NULL;
    
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
        $this->categories = new \Blacklist\Factory\CategoryFactory($db);
	$this->component = new CategoryComponentFactory($db, $this);
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
     * @return type
     */
    protected function createComponentEditform()
    {
	return $this->component->getEditCategoryForm(
	    $this->getParameter('id')
	);
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
	    $this->template->categories = $this->categories->getTree();
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderEdit($id)
    {
	    $this->template->category = $this->categories->getById($id);
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
	    return $this->component->getNewCategoryForm();
    }
    
    public function renderUpdateAll()
    {
        $priority = (isset($_POST['priority']) ? $_POST['priority'] : array());
        $visibility = (isset($_POST['visibility']) ? $_POST['visibility'] : array());
        $parent = (isset($_POST['parent']) ? $_POST['parent'] : array());
        
        $this->categories->updateAll($priority, $visibility, $parent);
        $this->flashMessage(STR_440, 'success');
        $this->redirect('Category:default');
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderDelete($id)
    {
        $category = $this->categories->getById($id);
        $category->setDatabase($this->database);
        $category->remove();
        $this->flashMessage(STR_14 . ' "' . $category->name . '" ' . STR_441, 'success');
        $this->redirect('Category:default');
    }
}