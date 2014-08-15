<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 04.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\User
 */
    
namespace
    Blacklist\Component\User;
    
use
    Nette\Application\UI\Form;
    
/**
 * This class is just Blacklist component 
 * for adding admin user profile.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class AddForm extends Form
{
    /**
     * This is the constructor of this class.
     * Just initialize component.
     * 
     * @param \Blacklist\Component\User\UserControl $user
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * This method just initialize the component form.
     * 
     * @param \Blacklist\Component\User\UserControl $user
     */
    private function init()
    {
        $this->addText('account', USER_ACC_LABEL)
            ->setRequired(STR_628)
            ->addRule(Form::MIN_LENGTH, STR_629, 5)
            ->addRule(Form::MAX_LENGTH, STR_630, 30);
        
        $this->addPassword('password', USER_PASS1_LABEL)
	    ->setRequired(STR_632)
            ->addRule(Form::MIN_LENGTH, STR_633, 6)
            ->addRule(Form::MAX_LENGTH, STR_634, 30);
        
        $this->addPassword('password1', USER_PASS2_LABEL)
	    ->setRequired(STR_635)
            ->addRule(Form::MIN_LENGTH, STR_633, 6)
            ->addRule(Form::MAX_LENGTH, STR_634, 30)
	    ->addRule(Form::EQUAL, STR_631, $this['password']);
        
        $this->addText('email', USER_EMAIL_LABEL)
            ->setType('email')
            ->setRequired(USER_EMAIL_REQ);

        $this->addText('username', USER_USERNAME_LABEL)
            ->setRequired(STR_636)
            ->addRule(Form::MIN_LENGTH, STR_637, 2)
            ->addRule(Form::MAX_LENGTH, STR_638, 40);

        $this->addText('surname', USER_SURNAME_LABEL)
            ->setRequired(STR_639)
            ->addRule(Form::MIN_LENGTH, STR_640, 2)
            ->addRule(Form::MAX_LENGTH, STR_641, 40);
	
        $this->addSelect('adminLevel', 'Level', array(
            'member'  => 'Uživatel',
            'editor'  => 'Moderátor',
            'admin'   => 'Administrátor'
        ));

        $this->addText('facebook', USER_FACEBOOK_LABEL);
        $this->addText('skype', USER_SKYPE_LABEL);
        $this->addText('birthday', USER_BIRTHDAY_LABEL);
        $this->addSubmit('send', USER_PROFILE_SUBMIT);
    }
}