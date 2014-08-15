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
    Blacklist\Factory\MenuFactory,
    Blacklist\Component\Menu\MenuComponentFactory;

/**
 * @author Томас Петр
 */
class MenuPresenter extends BasePresenter
{   
    /**
     *
     * @var type 
     */
    private $menus = NULL;
    
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
	$this->menus = new MenuFactory($db);
	$this->component = new MenuComponentFactory($db, $this);
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
	return $this->component->getEditMenuForm(
	    $this->getParameter('id')
	);
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
	$this->template->menus = $this->menus->getTree();
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderEdit($id)
    {
	$this->template->menu = $this->menus->getById($id);
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
	return $this->component->getNewMenuForm();
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
        $menu = $this->menus->getById($id);
	    $menu->remove();
        $this->flashMessage(STR_457 . ' ("' . $menu->name . '") ' . STR_458, 'success');
    }
    
    /**
     * 
     */
    public function renderUpdateAll()
    {
        $priority = (isset($_POST['priority']) ? $_POST['priority'] : array());
        $visibility = (isset($_POST['visibility']) ? $_POST['visibility'] : array());
        $parent = (isset($_POST['parent']) ? $_POST['parent'] : array());
        $this->menus->updateAll($priority, $visibility, $parent);
        $this->flashMessage(STR_460, 'success');
        $this->redirect('Menu:default');
    }
}