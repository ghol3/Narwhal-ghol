<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 15.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\User
 */

namespace 
    Blacklist\Factory;

use 
    Nette\Database\Context as Connection,
    Nette\Utils\Strings,
    Blacklist\Model\String\TableString as STable,
    Blacklist\Object\UserObject,
    Blacklist\Model\User\UserInfoAction;

/**
 * This class is used to model the user. 
 * Represents events for classic user model.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class UserFactory
{
    /**
     * This is the database connection by Nette Framework.
     * 
     * @var type \Nette\Database\Context 
     */
    private $database = NULL;
    
    /**
     * This is the main constructor of this class just a put
     * database connection into this class like private.
     * 
     * @param \Nette\Database\Context $db
     */
    public function __construct(Connection $db)
    {
	$this->database = $db;
    }
    
    /**
     * This method returns any user (just one) by primary key. 
     * (Make a new instance of user model and return it.)
     * 
     * @param type $id
     * @return \Blacklist\Model\User\UserControl
     */
    public function getById($id)
    {
        $user = $this->database->table(STable::USER)
            ->where('id', $id)->fetch();
        $object = new UserObject(NULL, NULL, NULL, NULL);
        $object->make($user);
        $object->setDatabase($this->database);
        return $object;
    }
    
    /**
     * This method returns any user (just one) by primary key. 
     * (Make a new instance of user model and return it.)
     * 
     * @param type $mail
     * @return \Blacklist\Model\User\UserControl
     */
    public function getByEmail($mail)
    {
        $user = $this->database->table(STable::USER)
            ->where('email', $mail)->fetch();
        $object = new UserObject(NULL, NULL, NULL, NULL);
        $object->make($user);
        $object->setDatabase($this->database);
        return $object;
    }
    
    /**
     * This method returns any user (just one) by primary key. 
     * (Make a new instance of user model and return it.)
     * 
     * @param type $acc
     * @return \Blacklist\Model\User\UserControl
     */
    public function getByAccount($acc)
    {
        $user = $this->database->table(STable::USER)
            ->where('account', $acc)->fetch();
        
        $object = new UserObject(NULL, NULL, NULL, NULL);
        $object->make($user);
        $object->setDatabase($this->database);
        return $object;
    }
    
    /**
     * This method returns all users from the database.
     * 
     * @return \Blacklist\Model\User\UserControl
     */
    public function getAll()
    {
        $users = $this->database->table(STable::USER);
        $userControls = array();
        foreach($users as $user)
        {
            $object = new UserObject(NULL, NULL, NULL, NULL);
            $object->make($user);
            $object->setDatabase($this->database);
            $userControls[] = $object;
        }
        return $userControls;
    }
    
    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct() 
    {
        unset($this->database);
    }
}