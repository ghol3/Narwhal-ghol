<?php

namespace 
    Blacklist\Factory;

use
    Blacklist\Model\String\TableString as Tables;

class TaskFactory extends \Nette\Object
{
    private $database;
    
    public function __construct(\Nette\Database\Context $db)
    {
        $this->database = $db;
    }
    
    public function getAll($conditions = NULL, $val1 = NULL, $val2 = NULL, $val3 = NULL)
    {
        if($conditions != NULL)
        {
            $tasks = $this->database->table(Tables::TASKS)
                    ->where($conditions, $val1, $val2, $val3);
        }
        else{
            $tasks = $this->database->table(Tables::TASKS);
        }
        
        $objectA = array();
        foreach($tasks as $task){
            $object = new \Blacklist\Object\TaskObject(NULL, NULL, NULL);
            $object->make($task);
            $object->setDatabase($this->database);
            $objectA[] = $object;
        }
        return $objectA;
    }
    
    /**
     * 
     * @param type $id
     * @return \Blacklist\Object\TaskObject
     */
    public function getById($id)
    {
        $object = new \Blacklist\Object\TaskObject(NULL, NULL, NULL);
        $task = $this->database->table(Tables::TASKS)->get($id);
        $object->make($task);
        $object->setDatabase($this->database);
        return $object;
    }
}

