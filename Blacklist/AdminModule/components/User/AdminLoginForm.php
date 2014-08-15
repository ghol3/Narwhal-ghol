<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 28.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\User
 */
    
namespace
    Blacklist\Component\User;
    
use
    Nette\Application\UI\Form;
    
/**
 * This class is just Blacklist component 
 * for admin login.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class AdminLoginForm extends Form
{
    
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     * 
     * @param type $key INTEGER <- security key
     */
    public function __construct($key, $sessions)
    {
        parent::__construct();
        $this->init($key, $sessions);
    }
    
    /**
     * This method just initialize the component form.
     * 
     * @param type $key INTEGER <- security key
     */
    private function init($key, $sessions)
    {
        $this->addText('account', USER_ACC_LOGIN_LABEL)
            ->setRequired(STR_628);
        
        $this->addPassword('password', USER_PASS_LOGIN_LABEL);
        $this->addHidden('challenge', $key);
        $this->addHidden('hpassword', '');
        $this->addCheckbox('remember', (isset($sessions->adminuser)) ? 1 : 0);
        $this->addSubmit('send', USER_LOGIN_SUBMIT);
    }
}