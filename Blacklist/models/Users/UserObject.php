<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 15.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package User
 */

namespace 
    Blacklist\Object;

use 
    Blacklist\Object\UserInfoFactory,
    Blacklist\Model\String\TableString as Tables;

/**
 * This class represents one user from the database as
 * such a stupid object. Why this way? Because I love it!
 * Fuck dynamic languages like PHP, I love data types azaza.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class UserObject extends Object implements IObject
{
    
    public
        /** @var type string    */
        $adminLevel         = NULL,
        /** @var type string    */
        $account            = NULL,
        /** @var type string    */
        $password           = NULL, 
        /** @var type string    */
        $email              = NULL,
        /** @var type timestamp */
        $lastLogin          = NULL,
        /** @var type timestamp */
        $registrationDate   = NULL,
        /** @var type integer   */
        $id                 = NULL;
    
    /** @var type \Blacklist\Object\UserInfoObject */
    private $userInfo = NULL;
    
    /**
     * User specification
     */
    public function __construct($acc, $pass, $email, $level)
    {
        $this->account	    = (string) $acc;
        $this->password	    = (string) $pass;
        $this->email	    = (string) $email;
        $this->adminLevel   = (string) $level;
        parent::__construct('\\Blacklist\Object\UserObject');
    }
    
    /**
     * This method create any user by user package model.
     * 
     * @param \Blacklist\Model\User\UserControl $item
     */
    public function create() 
    {
        $this->database->table(Tables::USER)
            ->insert($this->toArray());
    }
    
    /**
     * This method update any user by user model
     * using user model getId() method.
     * 
     * @param \Blacklist\Model\User\UserControl $item
     */
    public function update() 
    {
        $this->database->table(Tables::USER)
            ->where('id', $this->id)
            ->update($this->toArray());
    }

    /**
     * This method just remove any user by primary key.
     * 
     * @param type $id
     */
    public function remove() 
    {
        $this->userInfo = $this->getUserInfo();
        $this->userInfo->remove();
        $this->database->table(Tables::USER)
            ->where('id', $this->id)
            ->delete();
    }
    
    public function getUserInfo()
    {
        if($this->userInfo === NULL && $this->database)
        {
            $factory = new \Blacklist\Factory\UserInfoFactory($this->database);
            $this->userInfo = $factory->getByUser($this->id);
            $this->userInfo->setDatabase($this->database);
            unset($factory);
        }
        return $this->userInfo;
    }
    
    /**
     * destroy all instances that are no longer needed
     */
    public function __destruct()
    {
        unset($this->userInfo);
    }
}