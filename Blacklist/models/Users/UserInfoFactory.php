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
    Blacklist\Model\String\TableString as STable,
    Blacklist\Object\UserInfoObject;

/**
 * This class is used to model the user info. 
 * Represents events for classic user info model.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class UserInfoFactory
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
     * This method returns any userinfo (just one) by primary key. 
     * (Make a new instance of userinfo model and return it.)
     * 
     * @param type $id
     * @return \Blacklist\Model\User\UserControl
     */
    public function getByUser($id)
    {
        $userInfo = $this->database->table(STable::USERINFO)
            ->where('user', $id)->fetch();
        $object = new UserInfoObject(NULL, NULL, NULL);
        $object->make($userInfo);
        return $object;
    }
    
    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct() 
    {
        unset($this->database);
    }
}