<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 15.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Settings
 */

namespace
    Blacklist\Object;

/**
 * This class represents base settings from the database as
 * such a stupid object. Why this way? Because I love it!
 * Fuck dynamic languages like PHP, I love data types azaza.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class BasicSettingsObject
{
    public
        /** @var type string */
        $siteurl        = NULL,
        /** @var type string */
        $sitename       = NULL,
        /** @var type string */
        $sitedescription = NULL,
        /** @var type boolean */
        $users_can_register = 0,
        /** @var type string */ 
        $site_email     = NULL,
        /** @var type boolean */
        $site_smiles    = 0,
        /** @var type boolean */
        $require_registration_email = 0,
        /** @var type string */
        $copyright = NULL,
        /** @var type string */
        $social = NULL,
        /** @var type string */
        $footer = NULL,
        /** @var type int */
        $pagination = NULL,
        /** @var type int */
        $comment_only_user = NULL,
        /** @var type string */
        $username,
        /** @var type string */
        $surname,
        /** @var type string */
        $phone              = NULL,
        /** @var type string */
        $title              = NULL,
        /** @var type string */
        $keywords           = NULL,
        /** @var type int */
        $log_number         = NULL;
    
    /**
     * @return type array
     */
    public function getArray()
    {
        // hihi you can do it better :-D
        // yep, but NOT TODAY! :-D
        
        $array[] = array(
            'id' => '1',
            'name' => 'siteurl',
            'value' => (string) $this->siteurl
        );
        
        $array[] = array(
            'id' => '2',
            'name' => 'sitename',
            'value' => (string) $this->sitename
        );
        
        $array[] = array(
            'id' => '3',
            'name' => 'sitedescription',
            'value' => (string) $this->sitedescription
        );
        
        $array[] = array(
            'id' => '4',
            'name' => 'user_can_register',
            'value' => (int) $this->users_can_register
        );
        
        $array[] = array(
            'id' => '5',
            'name' => 'site_email',
            'value' => (string) $this->site_email
        );
        
        $array[] = array(
            'id' => '6',
            'name' => 'use_smiles',
            'value' => (int) $this->site_smiles
        );
        
        $array[] = array(
            'id' => '7',
            'name' => 'require_registration_email',
            'value' => (int) $this->require_registration_email
        );
        
        $array[] = array(
            'id' => '8',
            'name' => 'copyright',
            'value' => (string) $this->copyright
        );
        
        $array[] = array(
            'id' => '9',
            'name' => 'social',
            'value' => (string) $this->social
        );
        
        $array[] = array(
            'id' => '10',
            'name' => 'footer',
            'value' => (string) $this->footer
        );
        
        $array[] = array(
            'id'    => '11',
            'name'  => 'pagination',
            'value' => (int) $this->pagination
        );
        
        $array[] = array(
            'id'    => '12',
            'name'  => 'comment_only_user',
            'value' => (int) $this->comment_only_user
        );
        
        $array[] = array(
            'id'    => '13',
            'name'  => 'username',
            'value' => (string) $this->username
        );
        
        $array[] = array(
            'id'    => '14',
            'name'  => 'surname',
            'value' => (string) $this->surname
        );

        
        $array[] = array(
            'id'    => '15',
            'name'  => 'web_phone',
            'value' => $this->phone
        );
        
        $array[] = array(
            'id'    => '16',
            'name'  => 'web_title',
            'value' => $this->title
        );
        
        $array[] = array(
            'id'    => '17',
            'name'  => 'keywords',
            'value' => $this->keywords
        );
        
        $array[] = array(
            'id'    => '18',
            'name'  => 'log_number',
            'value' => $this->log_number
        );
        
        return $array;
    }
}