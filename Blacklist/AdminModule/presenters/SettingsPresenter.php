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
    Blacklist\Model\Settings\SettingsAction,
    Blacklist\Component\Settings\SettingsComponentFactory;

/**
 * @author Томас Петр
 */
class SettingsPresenter extends BasePresenter
{   
    
    private $settings = NULL;
    
    private $component = NULL;
    
    private $database = nuLl;
    
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
        $this->settings = new SettingsAction($db);
        $this->component = new SettingsComponentFactory($db, $this);
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
     * @return \Blacklist\Component\Settings\BasicSettingsForm
     */
    protected function createComponentEditBasicform()
    {
	    return $this->component->getBasicSettingsForm();
    }

    /**
     *
     */
    public function renderTestDisplay()
    {
        $this->template->settings = $this->settings->getBasicSettings();
    }
}