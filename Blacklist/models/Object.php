<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 14.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace Blacklist\Object;

use 
    Nette\Object as NObject;

/**
 * @author Томас Петр <www.beepvix.com>
 */
class Object extends NObject
{   
    /** @var type string */
    private $lClass = NULL;
    
    /** @var type \Nette\Database\Context */
    protected $database = NULL;
    
    /**
     * @param type $class string
     */
    public function __construct($class)
    {
        $this->lClass = $class;
    }
    
    /**
     * @param \Nette\Database\Context $db
     */
    public function setDatabase(\Nette\Database\Context $db)
    {
        $this->database = $db;
    }
    
    /**
     * this method initialize this object by extern array
     * @param type $data array
     */
    public function make($data)
    {
        foreach($data as $key => $value)
        {
            if(property_exists($this->lClass, $key)){
                $this->$key = $value;
            }
        }
    }
    
    /**
     * this method make data field from public variables
     * @return array
     */
    public function toArray($allowKeys = array())
    {   
        $array = array();
        foreach (get_class_vars(get_called_class()) as $key => $value)
        {
            $allowKeys['lClass'] = $this->lClass;
            if(isset($this->$key) && !is_object($this->$key) && !in_array($this->$key, $allowKeys)){
                $array[$key] = $this->$key;
            }
        }
        return $array;
    }
}