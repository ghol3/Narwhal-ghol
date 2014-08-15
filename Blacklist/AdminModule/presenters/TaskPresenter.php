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
    Nette\Database\Context;

/**
 * @author Томас Петр
 */
class TaskPresenter extends BasePresenter
{   
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
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
	$factory = new \Blacklist\Factory\TaskFactory($this->database);
        $this->template->tasks = $factory->getAll('status = ? OR status = ? OR status = ?', 'Nové', 'Rozpracované', 'Čeká na kontrolu');
    }
    
    /**
     * 
     */
    public function renderDone()
    {
        $factory = new \Blacklist\Factory\TaskFactory($this->database);
        $this->template->tasks = $factory->getAll('status = ? OR status = ? OR status = ?', 'Hotovo', 'Hotovo', 'Hotovo');
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderEdit($id)
    {
	    $factory = new \Blacklist\Factory\TaskFactory($this->database);
        $this->template->task = $factory->getById($id);
    }
    
    /**
     * 
     */
    public function renderAdd()
    {
	
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
        $factory = new \Blacklist\Factory\TaskFactory($this->database);
        $task = $factory->getById($id);
        $task->remove();
        $this->flashMessage(STR_507 .' "' . $task->name . '" ' . STR_435, 'success');
    }
    
    /**
     * 
     * @return type
     */
    protected function createComponentAddForm()
    {
        $comp = new \Blacklist\Component\Article\TaskComponentFactory($this->database, $this);
        return $comp->getNewTaskForm($this->getUser()->id);
    }
    
    /**
     * 
     * @return type
     */
    protected function createComponentEditForm()
    {
        $comp = new \Blacklist\Component\Article\TaskComponentFactory($this->database, $this);
        return $comp->getEditTaskForm($this->getUser()->id, $this->getParameter('id'));
    }
}