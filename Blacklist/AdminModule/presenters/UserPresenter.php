<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 04.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\AdminModule\Presenters
 */

namespace 
    Blacklist\AdminModule\Presenters;

use
    Nette,
    Nette\Database\Context,
    Blacklist\Model\User\UserAction,
    Blacklist\Component\User\UserComponentFactory;

/**
 * @author Томас Петр
 */
class UserPresenter extends BasePresenter
{   
    
    private $users = NULL;
    
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
	$this->users = new \Blacklist\Factory\UserFactory($db);
	$this->component = new UserComponentFactory($db, $this);
        $this->database = $db;
	//$this->component = new MenuComponentFactory($db, $this);
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
	return $this->component->getEditForm(
		$this->getParameter('id')
	);
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
	$this->template->users = $this->users->getAll();
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderEdit($id)
    {
	$this->template->user = $this->users->getById($id);
    }
    
    /**
     * 
     */
    public function renderAdd()
    {
	
    }
    
    public function renderProfile($id)
    {
        $this->template->user = $this->users->getById($id);
    }
    
    /**
     * 
     */
    protected function createComponentAddform()
    {
	return $this->component->getNewUserForm();
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
        $user = $this->users->getById($id);
        $user->remove();
        $this->flashMessage(STR_92 . ' "' . $user->account . '" ' . STR_435, 'success');
    }
}