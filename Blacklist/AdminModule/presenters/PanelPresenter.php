<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 05.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\AdminModule\Presenters
 */

namespace 
    Blacklist\AdminModule\Presenters;

use
    Nette,
    Nette\Database\Context,
    Blacklist\Factory\PanelFactory;

/**
 * @author Томас Петр
 */
class PanelPresenter extends BasePresenter
{   
    private $database = NULL;
    private $factory = NULL;
    
    /**
     * 
     * @param \Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
        $this->database = $db;
        $this->factory = new PanelFactory($db);
        parent::__construct();
    }
    
    /**
     * 
     */
    public function renderDefault()
    {
        $this->template->panels = $this->factory->getAll();
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderEdit($id)
    {
        $this->template->panel = $this->factory->getById($id);
    }
    
    /**
     * 
     * @return type
     */
    public function createComponentEditform()
    {
        $formFactory = new \Blacklist\Component\Panel\PanelComponentFactory($this->database, $this);
        return $formFactory->getEditPanelForm($this->getParameter('id'));
    }
    
    /**
     * 
     * @return type
     */
    protected function createComponentAddform()
    {
        $formFactory = new \Blacklist\Component\Panel\PanelComponentFactory($this->database, $this);
        return $formFactory->getNewPanelForm();
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
        $panel = $this->factory->getById($id);
        $panel->remove();
        $this->flashMessage(STR_500 . ' "' . $panel->name . '" ' . STR_435, 'success');
    }
    
    /**
     * 
     */
    public function renderChangeAll()
    {
        $priority = isset($_POST['priority']) ? $_POST['priority'] : array();
        $this->factory->updateAll($priority);
        $this->flashMessage(STR_502, 'success');
        $this->redirect('Panel:default');
    }
}