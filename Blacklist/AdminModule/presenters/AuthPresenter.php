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
    Nette\Database\Context,
    Blacklist\Component\User\UserComponentFactory as uFactory;

class AuthPresenter extends BasePresenter
{
    
    private $component = NULL;
    private $settings  = NULL;
    private $database  = NULL;
    
    /**
     * 
     * @param \Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
	    parent::__construct();
	    $this->component = new uFactory($db, $this);
        $this->settings = new \Blacklist\Model\Settings\SettingsAction($db);
        $this->database = $db;
    }
    
    /**
     * 
     */
    public function renderLogin()
    {
        $sessions = $this->getSession('user');
        $this->template->acc = (isset($sessions->adminuser) ? $sessions->adminuser : 'account');
        $this->template->pass = (isset($sessions->adminuserp) ? $sessions->adminuserp : 'password');
    }
    
    /**
     * 
     */
    public function renderTop()
    {
        $this->template->settings = $this->settings->getBasicSettings();
        $this->getDefaultInit($this->database);
    }
    
    /**
     * 
     */
    public function renderMenu()
    {
        $this->getDefaultInit($this->database);
        $this->template->user = $this->getUser();
    }
    
    /**
     * 
     * @return type
     */
    protected function createComponentAdminLoginForm()
    {
	    return $this->component->getAdminLoginForm();
    }
}