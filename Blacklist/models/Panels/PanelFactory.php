<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 19.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Page
 */

namespace 
    Blacklist\Factory;

use
    Nette\Database\Context,
    Blacklist\Object\PanelObject,
    Blacklist\Model\String\TableString as Tables;

/**
 * This class is used to model the panel. 
 * Represents events for classic panel model.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class PanelFactory
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
    public function __construct(Context $db)
    {
        $this->database = $db;
    }
    
    /**
     * This method returns any page (just one) by primary key. 
     * (Make a new instance of page model and return it.)
     * 
     * @param type $id int(11) (not null, primary key)
     * @return \Blacklist\Model\Page\PageControl
     */
    public function getById($id)
    {
        $dbPanel = $this->database->table(Tables::PANEL)->get($id);
        $object = new PanelObject(NULL);
        $object->make($dbPanel);
        $object->setDatabase($this->database);
        return $object;
    }
    
    /**
     * This method returns all pages like model objects.
     * (Using just for administration cause we don`t want
     * visible pages... for this question is easy answer)
     * -> getVisibleCollection() 
     * 
     * @return \Blacklist\Model\Page\PageControl
     */
    public function getAll()    
    {
        $panels = $this->database->table(Tables::PANEL)
            ->order('priority DESC');
        $aControls = array();
        foreach($panels as $panel)
        {
            $object = new PanelObject(NULL);
            $object->make($panel);
            $object->setDatabase($this->database);
            $aControls[] = $object;
        }
        return $aControls;
    }
    
    /**
     * 
     * @param type $pos
     * @return type
     */
    public function getByPosition($pos)
    {
	$panels = $this->database->table(Tables::PANEL)
		->where(array('position' => $pos, 'visibility' => 1))
		->order('priority DESC');
	$aControls = array();
        foreach($panels as $panel)
        {
            $object = new PanelObject(NULL);
            $object->make($panel);
            $object->setDatabase($this->database);
            $aControls[] = $object;
        }
        return $aControls;
    }
    
    public function getLeft()
    {
        $panels = $this->database->table(Tables::PANEL)
            ->where('position', 'l')
            ->order('priority DESC');
        $aControls = array();
        foreach($panels as $panel)
        {
            $object = new PanelObject(NULL);
            $object->make($panel);
            $object->setDatabase($this->database);
            $aControls[] = $object;
        }
        return $aControls;
    }
    
    public function getRight()
    {
        $panels = $this->database->table(Tables::PANEL)
            ->where('position', 'r')
            ->order('priority DESC');
        $aControls = array();
        foreach($panels as $panel)
        {
            $object = new PanelObject(NULL);
            $object->make($panel);
            $object->setDatabase($this->database);
            $aControls[] = $object;
        }
        return $aControls;
    }
    
    public function getBottom()
    {
        $panels = $this->database->table(Tables::PANEL)
            ->where('position', 'b')
            ->order('priority DESC');
        $aControls = array();
        foreach($panels as $panel)
        {
            $object = new PanelObject(NULL);
            $object->make($panel);
            $object->setDatabase($this->database);
            $aControls[] = $object;
        }
        return $aControls;
    }
    
    public function getTop()
    {
        $panels = $this->database->table(Tables::PANEL)
            ->where('position', 't')
            ->order('priority DESC');
        $aControls = array();
        foreach($panels as $panel)
        {
            $object = new PanelObject(NULL);
            $object->make($panel);
            $object->setDatabase($this->database);
            $aControls[] = $object;
        }
        return $aControls;
    }
    
    /**
     * This method only cleans class at the destruction.
     */
    public function __destruct()
    {
        unset($this->database);
    }
    
    /**
     * 
     * @param type $priority
     */
    public function updateAll($priority)
    {
        foreach($priority as $key => $prt){
            $this->database->table(Tables::PANEL)
                    ->where('id', $key)
                    ->update(array('priority' => $prt));
        }
    }
}