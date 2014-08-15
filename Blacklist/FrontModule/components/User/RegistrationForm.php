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
 * for normal user registration.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class RegistrationForm extends Form
{
    
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init()
    {
        $this->addText('account', USER_ACC_LABEL)
            ->setRequired(USER_ACC_REQ)
            ->addRule(Form::MIN_LENGTH, USER_ACC_MIN_LENGTH, 6)
            ->addRule(Form::MAX_LENGTH, USER_ACC_MAX_LENGTH, 30);
        
        $this->addPassword('password1', USER_PASS1_LABEL)
            ->setRequired(USER_PASS1_REQ)
            ->addRule(Form::MIN_LENGTH, USER_PASS1_MIN_LENGTH, 6)
            ->addRule(Form::MAX_LENGTH, USER_PASS1_MAX_LENGTH, 30);
        
        $this->addPassword('password2', USER_PASS2_LABEL)
            ->setRequired(USER_PASS2_REQ)
            ->addRule(Form::MIN_LENGTH, USER_PASS2_MIN_LENGTH, 6)
            ->addRule(Form::MAX_LENGTH, USER_PASS2_MAX_LENGTH, 30);
        
        $this->addText('email', USER_EMAIL_LABEL)
            ->setType('email')
            ->setRequired(USER_EMAIL_REQ);
        
        $this->addText('username', USER_USERNAME_LABEL)
            ->setRequired(USER_USERNAME_REQ)
            ->addRule(Form::MIN_LENGTH, USER_USERNAME_MIN_LENGTH, 2)
            ->addRule(Form::MAX_LENGTH, USER_USERNAME_MAX_LENGTH, 40);

        $this->addText('surname', USER_SURNAME_LABEL)
            ->setRequired(USER_SURNAME_REQ)
            ->addRule(Form::MIN_LENGTH, USER_SURNAME_MIN_LENGTH, 2)
            ->addRule(Form::MAX_LENGTH, USER_SURNAME_MAX_LENGTH, 40);
        
        $this->addSubmit('send', USER_REGISTRATION_SUBMIT);
    }
}