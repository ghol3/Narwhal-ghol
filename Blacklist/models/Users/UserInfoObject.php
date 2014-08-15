<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 15.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\User
 */

namespace 
    Blacklist\Object;

use
    Blacklist\Model\String\TableString as Tables;

/**
 * This class represents one user-info from the database as
 * such a stupid object. Why this way? Because I love it!
 * Fuck dynamic languages like PHP, I love data types azaza.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class UserInfoObject extends Object implements IObject
{
    
    public
        /** @var type string */
        $username       = NULL,
        /** @var type string */
        $surname        = NULL,
        /** @var type timestamp */
        $birthday       = NULL,
        /** @var type string */
        $facebook       = NULL,
        /** @var type string */
        $skype          = NULL,
        /** @var type int */
        $user           = NULL,
        $id             = NULL;

    /**
     * User-info item specification
     */
    public function __construct($username, $surname, $birthday)
    {
        $this->username = (string) $username;
        $this->surname  = (string) $surname;
        $this->birthday = $birthday;
        parent::__construct('\\Blacklist\Object\UserInfoObject');
    }
    
    /**
     * This method create any userinfo by userinfo package model.
     * 
     * @param \Blacklist\Model\User\UserInfoControl $item
     */
    public function create() 
    {
        $this->database->table(Tables::USERINFO)
            ->insert($this->toArray());
    }
    
    /**
     *  This method update any userinfo by userinfo model
     * using userinfo model getUserId() method.
     * 
     * @param \Blacklist\Model\Menu\UserControl $item
     */
    public function update() 
    {
        $this->database->table(Tables::USERINFO)
            ->where('id', $this->id)
            ->update($this->toArray());
    }

    /**
     * This method just remove any userinfo by primary key.
     * 
     * @param type $id
     */
    public function remove() 
    {
        $this->database->table(Tables::USERINFO)
            ->where('user', $this->user)
            ->delete();
    }
}