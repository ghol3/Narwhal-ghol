<?php

namespace
    Blacklist\Object;

use
    Blacklist\Model\String\TableString as Tables;   

class TaskObject extends \Blacklist\Object\Object implements \Blacklist\Object\IObject
{
    
    public 
        /** @var type int */
        $id             = NULL,
        /** @var type string */
        $name           = NULL,
        /** @var type timestamp */
        $createDate     = NULL,
        /** @var type string */
        $type           = NULL,
        /** @var type string */
        $status         = NULL,
        /** @var type string */
        $content        = NULL,
        /** @var type string */
        $comment        = NULL,
        /** @var type int */
        $author         = NULL,
        /** @var type string y/n */
        $email          = NULL,
        /** @var type string y/n */
        $phone          = NULL,
        /** @var type string */
        $image          = NULL,
        $done           = NULL;
    
    private
        /** @var type \Blacklist\Object\UserObject */
        $authorObject   = NULL,
        $doneObject     = NULL;
    
    public function __construct($name, $type, $status)
    {
        $this->name = (string) $name;
        $this->type = (string) $type;
        $this->status = (string) $status;
        parent::__construct('\Blacklist\Object\TaskObject');
    }
    
    /**
     * 
     */
    public function create() 
    {
        $this->status = 'Nové';
        $this->database->table(Tables::TASKS)
                ->insert($this->toArray());
    }

    /**
     * 
     */
    public function remove() 
    {
        $this->database->table(Tables::TASKS)
                ->where('id', $this->id)
                ->delete();
    }

    /**
     * 
     */
    public function update() 
    {
       $this->database->table(Tables::TASKS)
               ->where('id', $this->id)
               ->update($this->toArray());
    }
    
    /**
     * 
     * @return type
     */
    public function getAuthorObject()
    {
        if($this->authorObject === NULL && $this->database)
        {
            $factory = new \Blacklist\Factory\UserFactory($this->database);
            $this->authorObject = $factory->getById($this->author);
            unset($factory);
        }
        return $this->authorObject;
    }
    
    public function getDoneObject()
    {
        if($this->doneObject === NULL && $this->database)
        {
            $factory = new \Blacklist\Factory\UserFactory($this->database);
            $this->doneObject = $factory->getById($this->done);
            unset($factory);
        }
        return $this->doneObject;
    }
}

