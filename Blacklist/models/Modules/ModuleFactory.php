<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 21.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Article
 */

namespace 
    Blacklist\Factory;

use
    Nette\Database\Context              as Database,
    Nette\Object                        as NObject,
    Blacklist\Model\String\TableString  as Tables;

/**
 * This class is used to model the article. 
 * Represents events for classic articles models.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class ModuleFactory extends NObject
{
    
    /** @var type \Nette\Database\Context */
    private $database = NULL;
    
    /**
     * database specification
     */
    public function __construct(Database $database)
    {
        $this->database = (object) $database;
    }
    
    /**
     * 
     * @param type $id
     * @return \Blacklist\Object\ModuleObject
     */
    public function getById($id)
    {
        $module = new \Blacklist\Object\ModuleObject(NULL, NULL, NULL);
        $dmodule = $this->database->table(Tables::MODULES)->get($id);
        $module->make($dmodule);
        return $module;
    }
    
    /**
     * 
     * @return \Blacklist\Object\ModuleObject
     */
    public function getAll()
    {
        $array = array();
        $dmodules = $this->database->table(Tables::MODULES);
        foreach($dmodules as $dmodule){
            $module = new \Blacklist\Object\ModuleObject(NULL, NULL, NULL);
            $module->make($dmodule);
            $array[] = $module;
        }
        return $array;
    }
    
    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct()
    {
        unset($this->database);
    }
}