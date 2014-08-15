<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 02.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Security
 */

namespace Blacklist\Model\Security;

use Nette,
    Blacklist\Model\String\TableString as STable;


/**
 * This class provides a secure user login.
 *
 * @author Томас Петр
 */
class UserAuthenticator extends Nette\Object implements Nette\Security\IAuthenticator
{
    const
        TABLE_NAME              = STable::USER,     // user database table
        TABLE_KEYS              = STable::FORMKEYS, // table with admin user login form keys
        COLUMN_ID               = 'id',             // user table id attribute
        COLUMN_NAME             = 'account',        // user table account attribute
        COLUMN_PASSWORD_HASH    = 'password',       // user table password attribute
        COLUMN_ROLE             = 'adminLevel';     // user table admin level attribute
    
    /**
     * Instance of database connection.
     *
     * @var \Nette\Database\Context
     */
    private $database;

    /**
     * This is the constructor of this class. Only set the database
     * instance to a private variable.
     *
     * @param type $db \Nette\Database\Context
     */
    public function __construct(Nette\Database\Context $db)
    {
	$this->database = $db;
    }
    
    /**
     * This method verifies that the login to the system is successful or not.
     *
     * @param type $credentials array with variables
     */
    public function authenticate(array $credentials)
    {
        $date = new \Nette\Datetime();
        // getting data from admin login form
        list($account, $password, $key) = $credentials;
        // remove old keys (older than 5 minutes)
        $this->database->table(self::TABLE_KEYS)->where('created < ?', $date->getTimestamp() - 300)->delete();
        // getting unique database key and user row
        $databaseKeyRow = $this->database->table(self::TABLE_KEYS)->where(self::COLUMN_ID, $key)->fetch();
        $databaseUserRow = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $account)->fetch();
        // database key row or user row does not exists
        if((!$databaseKeyRow))
        {
            // Time to log into the system runs out!
            throw new Nette\Security\AuthenticationException(
                MSG_USER_LOGIN_TIMEOUT,
                self::IDENTITY_NOT_FOUND
            );
        }
        else if((!$databaseUserRow))
        {
            // The specified user account is incorrect!
            throw new Nette\Security\AuthenticationException(
                MSG_USER_LOGIN_NO_USER,
                self::IDENTITY_NOT_FOUND
            );
        }
        else
        {
            // User account exists a unique key is fine.
            // hash correct password with unique form key
            $correctPassword =  hash(STable::HASH_TYPE, $databaseUserRow->password . $key);
            // random rehash for admins azaza and comparing passwords
            if(hash(STable::HASH_TYPE, $correctPassword . STable::ADMIN_SALT) == hash(STable::HASH_TYPE, $password . STable::ADMIN_SALT))
            {
                // Everything is fine and the user will be logged.
                $this->database->table(self::TABLE_KEYS)->where(self::COLUMN_ID, $key)->delete();
                return new Nette\Security\Identity($databaseUserRow->id, $databaseUserRow->adminLevel);
            }
            else
            {
                // your password is incorrect azaza
                throw new Nette\Security\AuthenticationException(
                    MSG_USER_LOGIN_NO_PASSWORD,
                    self::INVALID_CREDENTIAL
                );
            }
        }
        
    }
}
