<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 15.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Settings
 * @license http://BSD.com BSD
 */

namespace
    Blacklist\Model\Settings;

use 
    Blacklist\Object\BasicSettingsObject,
    Nette\Database\Context,
    Blacklist\Model\String\TableString;

/**
 * This class is used to model the settings. 
 * Represents events for classic settings models.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class SettingsAction
{
    
    /**
     *
     * @var type 
     */
    private $database = NULL;

    /**
     * @param Context $db
     */
    public function __construct(Context $db)
    {
	    $this->database = $db;
    }

    /**
     * @param BasicSettingsObject $basic
     */
    public function updateBasicSettings(BasicSettingsObject $basic)
    {
        $this->database->table(TableString::BASIC_SETTINGS)
                    ->where('id < 20')->delete();
        foreach($basic->getArray() as $data)
        {
            $this->database->table(TableString::BASIC_SETTINGS)
                ->insert($data);
        }
    }
    
    /**
     * 
     * @return \Blacklist\Model\Settings\BasicSettingsControl
     */
    public function getBasicSettings()
    {
        $dbSettings = $this->database->table(TableString::BASIC_SETTINGS);
        $settings = new BasicSettingsObject();
        $settings->siteurl = $dbSettings[1]->value;
        $settings->sitename = $dbSettings[2]->value;
        $settings->sitedescription = $dbSettings[3]->value;
        $settings->users_can_register = $dbSettings[4]->value;
        $settings->site_email = $dbSettings[5]->value;
        $settings->site_smiles = $dbSettings[6]->value;
        $settings->require_registration_email = $dbSettings[7]->value;
        $settings->copyright = $dbSettings[8]->value;
        $settings->social = $dbSettings[9]->value;
        $settings->footer = $dbSettings[10]->value;
        $settings->pagination = $dbSettings[11]->value;
        $settings->comment_only_user = $dbSettings[12]->value;
        $settings->username = $dbSettings[13]->value;
        $settings->surname = $dbSettings[14]->value;
        $settings->phone = $dbSettings[15]->value;
        $settings->title = $dbSettings[16]->value;
        $settings->keywords = $dbSettings[17]->value;
        $settings->log_number = $dbSettings[18]->value;
        return $settings;
    }
}