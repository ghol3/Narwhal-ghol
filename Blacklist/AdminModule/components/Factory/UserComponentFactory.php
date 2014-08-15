<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 15.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\User
 */

namespace 
    Blacklist\Component\User;
    
use
    Nette\Database\Context,
    Nette\Object as NObject,
    Blacklist\Factory\UserInfoFactory,
    Blacklist\Factory\UserFactory,
    Blacklist\Model\String\TableString,
    Blacklist\Model\User\UserInfoControl,
    Blacklist\Model\User\UserControl;

/**
 * This class is component factory for
 * user components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class UserComponentFactory extends NObject
{
    /**
     * Instance of any presenter for messages & redirecting.
     *
     * var type $presenter
     */
    private $presenter = NULL;
    
    /**
     * Instance of Nette database connection.
     * 
     * var type $database \Nette\Database\Context
     */
    private $database = NULL;
    
    /** d
     * Instance of user action model.
     * 
     * @var type \Blacklist\Model\User\UserAction
     */
    private $users = NULL;
    
    /**
     *
     * @var type 
     */
    private $info = NULL;
    
    /**
     * Constructor of this class, set database connection 
     * like private and load the presenter + default init.
     * 
     * @param \Nette\Database\Context $db
     * @param type $presenter
     */
    public function __construct(Context $db, $presenter)
    {
        $this->database = $db;
        $this->presenter = $presenter;
        $this->users = new UserFactory($db);
	$this->info = new UserInfoFactory($db);
    }
    
    /**
     * 
     * @param type $id
     * @return \Blacklist\Component\User\EditForm
     */
    public function getEditForm($id)
    {
	$form = new EditForm($this->users->getById($id));
	$form->onSuccess[] = $this->editFormSubmitted;
	return $form;
    }
    
    /**
     * 
     * @param \Blacklist\Component\User\EditForm $form
     */
    public function editFormSubmitted(EditForm $form)
    {
	$data = $form->getValues();
	
        $info = new \Blacklist\Object\UserInfoObject($data->username, $data->surname, $data->birthday);
        $info->facebook = $data->facebook;
        $info->skype = $data->skype;
        $info->id = $data->info;
        $info->setDatabase($this->database);
        $info->update();
        
        $user = new \Blacklist\Object\UserObject($data->account, hash('sha512', $data->password), $data->email, $data->adminLevel);
	$user->id = $data->user;
        if($data->password === ''){
            $user->password = NULL;
        }
        $user->setDatabase($this->database);
        $user->update();
        $this->presenter->flashMessage(STR_92 . ' "' . $user->account . '" ' . STR_453, 'success');
        $this->presenter->redirect('this');
    }
    
    /**
     * This method returns login component for
     * normal users.
     * 
     * @return \Blacklist\Component\User\LoginForm
     */
    public function getLoginForm()
    {
        $datetime = new \Nette\Datetime();
        $this->database->table(TableString::FORMKEYS)->insert(array('created' => $datetime->getTimestamp()));
        $key = $this->database->table(TableString::FORMKEYS)->where('created', $datetime->getTimestamp())->fetch();
        $form = new AdminLoginForm($key);
        $form->onSuccess[] = $this->loginFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @return \Blacklist\Component\User\AddForm
     */
    public function getNewUserForm()
    {
        $form = new AddForm();
        $form->onSuccess[] = $this->addNewUserSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param \Blacklist\Component\User\AddForm $form
     */
    public function addNewUserSubmitted(AddForm $form)
    {
        $data = $form->getValues();
        $user = new \Blacklist\Object\UserObject($data->account, hash('sha512', $data->password), $data->email, $data->adminLevel);
        $user->setDatabase($this->database);
        $user->create();

        $u = $this->users->getByAccount($data->account);
        $info = new \Blacklist\Object\UserInfoObject($data->username, $data->surname, $data->birthday);
        $info->facebook = $data->facebook;
        $info->skype = $data->skype;
        $info->user = $u->id;
        $info->setDatabase($this->database);
        $info->create();

        
        $this->presenter->flashMessage(STR_92 .' "' . $user->account . '" ' . STR_451, 'success');
        $this->presenter->redirect('User:default');
    }
    
    /**
     * This method returns registration component for
     * normal users.
     * 
     * @return \Blacklist\Component\User\RegistrationForm
     */
    public function getRegistrationForm()
    {
        $form = new RegistrationForm;
        $form->onSuccess[] = $this->registrationFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns profile edit form component
     * for normal users by primary key.
     * 
     * @param type $userId INTEGER (primary key)
     * @return \Blacklist\Component\User\ProfileForm
     */
    public function getProfileForm($userId)
    {
        $user = $this->users->getById($userId);
        $form = new ProfileForm($user, $user->getInfo($this->database));
        $form->onSuccess[] = $this->profileFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns login component for
     * admins.
     * 
     * @return \Blacklist\Component\User\AdminLoginForm
     */
    public function getAdminLoginForm()
    {
        $datetime = new \Nette\Datetime();
        $this->database->table(TableString::FORMKEYS)->insert(array('created' => $datetime->getTimestamp()));
        $key = $this->database->table(TableString::FORMKEYS)->where('created', $datetime->getTimestamp())->fetch();
        $form = new AdminLoginForm($key, $this->presenter->getSession('user'));
        $form->onSuccess[] = $this->adminLoginFormSubmitted;
        return $form;
    }
    
    /**
     * This method is event for admin login form component.
     * Just try login by account, password etc. (only for admins)
     * 
     * @param \Blacklist\Component\User\AdminLoginForm $form
     */
    public function adminLoginFormSubmitted(AdminLoginForm $form)
    {
        $user = $this->presenter->getUser();
        $data = $form->getValues();
        try
        {
            $user->setAuthenticator(new \Blacklist\Model\Security\AdminAuthenticator($this->database));
            $user->login($data->account, $data->hpassword, $data->challenge);
            $user->setExpiration('720 minutes', TRUE);
            $this->presenter->flashMessage(MSG_USER_LOGIN_SUCCESS);
            $u = $this->presenter->getSession('user');

            if($data->remember){
                $u->adminuser = $data->account;
            }else{
                unset($u->adminuser);
            }
            
        }catch (\Nette\Security\AuthenticationException $e)
        {
            $this->presenter->flashMessage((string)$e->getMessage());
        }
        $this->presenter->redirect('login');
    }
    
    /**
     * This method is event for login form component.
     * Just try login by account, password etc. (for normal users)
     * 
     * @param \Blacklist\Component\User\LoginForm $form
     */
    public function loginFormSubmitted(AdminLoginForm $form)
    {
        $user = $this->presenter->getUser();
        $data = $form->getValues();
        try
        {
            $user->setAuthenticator(new \Blacklist\Model\Security\UserAuthenticator($this->database));
            $user->login($data->account, $data->hpassword, $data->challenge);
            $user->setExpiration('30 minutes', TRUE);
            $this->presenter->flashMessage(MSG_USER_LOGIN_SUCCESS);
            
        }catch (\Nette\Security\AuthenticationException $e)
        {
            $this->presenter->flashMessage((string)$e->getMessage(), 'error');
        }
        $this->presenter->redirect('login');
    }
    
    /**
     * This method is event for regstration component.
     * Just create a new user (only for normal users).
     * 
     * @param \Blacklist\Component\User\RegistrationForm $form
     */
    public function registrationFormSubmitted(RegistrationForm $form)
    {
        // TODO: REGISTRATION
        $this->presenter->flashMessage(MSG_USER_REGISTRATION_SUCCESS, 'success');
    }
    
    /**
     * This method is event for user profile edit component.
     * Just update user info by primary key. (only for users)
     * 
     * @param \Blacklist\Component\User\ProfileForm $form
     */
    public function profileFormSubmitted(ProfileForm $form)
    {
        // TODO: PROFILEFORM
        $this->presenter->flashMessage(MSG_USER_PROFILE_SUCCESS, 'success');
    }
    
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
        unset($this->database);
        unset($this->users);
    }
}