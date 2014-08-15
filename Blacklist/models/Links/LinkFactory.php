<?php

namespace
    Blacklist\Factory;

use
    Blacklist\Model\String\TableString as Tables;

class LinkFactory
{
    /**
     * @var \Nette\Database\Context
     */
    private $database;

    /**
     * @param \Nette\Database\Context $db
     */
    public function __construct(\Nette\Database\Context $db)
    {
        $this->database = $db;
    }

    /**
     * @param $url
     * @return \Blacklist\Object\LinkObject
     */
    public function getByUrl($url)
    {
        $link = $this->database->table(Tables::LINKS)
                ->where('path', $url)->fetch();
        $linkObject = new \Blacklist\Object\LinkObject(NULL, NULL, NULL);
        if($link){ $linkObject->make($link); }
        $linkObject->setDatabase($this->database);
        return $linkObject;
    }

    /**
     * @param $id
     * @return \Nette\Database\Table\IRow
     */
    public function getById($id)
    {
        $link = $this->database->table(Tables::LINKS)
                ->get($id);
        $linkObject = new \Blacklist\Object\LinkObject(NULL, NULL, NULL);
        if($link){ $linkObject->make($link); }
        $linkObject->setDatabase($this->database);
        return $link;
    }
}