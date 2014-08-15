<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 25.06.2014
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
class UserPresenter extends BasePresenter
{   
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
    }
    
    public function renderDefault()
    {
        if($this->template->settings->users_can_register)
        {
            $uFactory = new \Blacklist\Factory\UserFactory($this->database);
            $this->template->userData = $uFactory->getById($this->getUser()->id);
        }
    }
    
    public function renderEdit()
    {
        if($this->template->settings->users_can_register)
        {
            $uFactory = new \Blacklist\Factory\UserFactory($this->database);
            $this->template->userData = $uFactory->getById($this->getUser()->id);
        }
    }
    
    public function renderLogin()
    {
        
    }
    
    protected function createComponentLoginForm()
    {
        $userComponent = new \Blacklist\Component\User\UserComponentFactory($this->database, $this);
        return $userComponent->getLoginForm();
    }
    
    protected function createComponentRegistrationForm()
    {
        $userComponent = new \Blacklist\Component\User\UserComponentFactory($this->database, $this);
        return $userComponent->getRegistrationForm();
    }
    
    protected function createComponentEditForm()
    {
        $userComponent = new \Blacklist\Component\User\UserComponentFactory($this->database, $this);
        return $userComponent->getEditForm($this->getUser()->id);
    }
}