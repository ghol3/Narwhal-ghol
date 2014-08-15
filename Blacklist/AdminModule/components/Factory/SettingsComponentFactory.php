<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 05.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Settings
 */
    
namespace
    Blacklist\Component\Settings;
    
use
    Nette\Database\Context,
    Blacklist\Model\Settings\SettingsAction,
    Blacklist\Model\Settings\BasicSettingsControl;
    
/**
 * This class is component factory for
 * page components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class SettingsComponentFactory extends \Nette\Object
{
    private $database;
    
    private $settings = NULL;
    /**
     * Instance of any presenter for messages & redirecting.
     *
     * var type 
     */
    private $presenter = NULL;
    
    /**
     * Constructor of this class, set database connection 
     * like private and load the presenter + default init.
     * 
     * @param \Nette\Database\Context $db
     * @param type $presenter
     */
    public function __construct(Context $db, $presenter)
    {
	    $this->settings = new SettingsAction($db);
        $this->presenter    = $presenter;
        $this->database = $db;
    }
    
    /**
     * 
     * @return \Blacklist\Component\Settings\BasicSettingsForm
     */
    public function getBasicSettingsForm()
    {
        $form = new BasicSettingsForm($this->settings->getBasicSettings());
        $form->onSuccess[] = $this->basicSettingsFormSubmitted;
        return $form;
    }
    
    public function basicSettingsFormSubmitted(BasicSettingsForm $form)
    {
        $data = $form->getValues();
        $settings = new \Blacklist\Object\BasicSettingsObject();
        $settings->require_registration_email = $data->require_registration_email;
        $settings->sitedescription = $data->sitedescription;
        $settings->site_email = $data->site_email;
        $settings->sitename = $data->site_name;
        $settings->siteurl = $data->site_url;
        $settings->site_smiles = $data->use_smiles;
        $settings->users_can_register = $data->users_can_register;
        $settings->copyright = $data->copyright;
        $settings->social = $data->social;
        $settings->footer = $data->footer;
        $settings->pagination = $data->pagination;
        $settings->comment_only_user = $data->comment_only_user;
        $settings->username = $data->username;
        $settings->surname = $data->surname;
        $settings->phone = $data->phone;
        $settings->title = $data->title;
        $settings->keywords = $data->keywords;
        $settings->log_number = $data->log_number;
        $this->settings->updateBasicSettings($settings);
        $this->presenter->flashMessage(STR_541, 'success');
        $this->presenter->redirect('this');
    }
        
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
        unset($this->settings);
    }
}