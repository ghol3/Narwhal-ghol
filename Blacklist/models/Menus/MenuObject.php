<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 06.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */

namespace
    Blacklist\Object;

use
    Nette\Utils\Arrays,
    Blacklist\Model\String\TableString as Tables;

/**
 * This class represents one menu item from the database as
 * such a stupid object. Why this way? Because I love it!
 * Fuck dynamic languages like PHP, I love data types azaza.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class MenuObject extends Object implements IObject
{
    
    public 
        /** @var type string */
        $name           = NULL,
        /** @var type string */
        $link           = NULL,
        /** @var type string */
        $description    = NULL,
        /** @var type string */
        $image          = NULL,
        /** @var type boolean */
        $visibility     = 0,
        /** @var type int */
        $priority       = NULL,
        /** @var type int */
        $submenu        = 0,
        /** @var type int */
        $id             = NULL;
    
    private
        /** @var type int */
        $parent         = NULL,
        /** @var type \Blacklist\Object\MenuObject */
        $parentObject   = NULL,
        /** @var type array of \Blacklist\Object\MenuObject */
        $submenus       = array(),
        $linkObject     = NULL,
        $parentIndex;

    /**
     * Menu item specification
     */
    public function __construct($name, $link)
    {
        $this->name = (string) $name;
        $this->link = (string) $link;
        parent::__construct('\\Blacklist\Object\MenuObject');
    }
    
    /**
     * 
     * @return type
     */
    public function getLinkObject()
    {
        if($this->linkObject === NULL && $this->database)
        {
            $factory = new \Blacklist\Factory\LinkFactory($this->database);
            $this->linkObject = $factory->getByUrl($this->link);
            unset($factory);
        }
        return $this->linkObject;
    }
    
    public function getUrl()
    {
        $myLink = $this->getLinkObject();
        return ($myLink->path != NULL) ? $myLink->presenter . ':' . $myLink->action : FALSE;
    }
    
    /**
     * This method just get the menu item from method header
     * and past him into database like new menu item.
     * 
     * @param \Blacklist\Model\Menu\MenuControl $item
     */
    public function create()
    {
        $this->priority = (count($this->database->table(Tables::MENU)));
        if($this->visibility){
            $this->visibility = 1;
        }
        $this->database->table(Tables::MENU)->insert($this->toArray());
        // this menu item is new and submenu?
        if($this->submenu && $this->id === NULL && $this->parent !== NULL)
        {
            $dbItem = $this->database->table(Tables::MENU)
                ->where('link', $this->link)->fetch();
            $data = array
            (
                'menu'	    => $this->parent,
                'submenu'   => $dbItem->id
             );
            $this->database->table(Tables::SUBMENU)->insert($data);
        }
    }
    
    /**
     * This method edit the menu item in the database 
     * by menu control instance.
     * 
     * @param \Blacklist\Model\Menu\MenuControl $item
     */
    public function update()
    {
        $factory = new \Blacklist\Factory\MenuFactory($this->database);
        $oldItem = $factory->getById($this->id);
        // old item is main menu and now submenu?
        if(!$oldItem->submenu && $this->submenu && $this->parent !== NULL)
        {
            $data = array
            (
                'menu'      => $this->parent,
                'submenu'   => $oldItem->id
            );
            $this->database->table(Tables::SUBMENU)->insert($data);
            $this->database->table(Tables::MENU)->where('id', $this->id)->update(array('submenu' => 1));
        }
        // old item is submenu and now is main menu?
        else if($oldItem->submenu && !$this->submenu)
        {
            $this->database->table(Tables::SUBMENU)
                ->where('submenu', $this->id)
                ->delete();
            $this->database->table(Tables::MENU)->where('id', $this->id)->update(array('submenu' => 0));
        }
        else if($oldItem->submenu && $this->submenu && $this->parent !== NULL)
        {
            $this->database->table(Tables::SUBMENU)
                ->where('submenu', $this->id)
                ->delete();
            $data = array
            (
                'menu'	=> $this->parent,
                'submenu'   => $oldItem->id
            );
            $this->database->table(Tables::SUBMENU)->insert($data);
        }
        
        $this->database->table(Tables::MENU)
            ->where('id', $this->id)
            ->update(array_merge($this->toArray(), array('visibility' => (int)$this->visibility)));
    }
    
    /**
     * This method just remove menu item from database 
     * by primary key id.
     * 
     * @param type $id int (primary key)
     */
    public function remove()
    {
        $parents = $this->database->table(Tables::SUBMENU)
            ->where('menu', $this->id);
        // set parent as normal item (!parent)
        foreach($parents as $parent)
        {
            $this->database->table(Tables::MENU)
                ->where('id', $parent->submenu)
                ->update(array('submenu' => 0));
        }
        // remove parents
        $this->database->table(Tables::SUBMENU)
            ->where('menu', $this->id)->delete();
        // remove sons
        $this->database->table(Tables::SUBMENU)
            ->where('submenu', $this->id)->delete();
        // remove menu item
        $this->database->table(Tables::MENU)
            ->where('id', $this->id)->delete();
    }
    
    /**
     * 
     * @return type
     */
    public function getParentObject()
    {
        if($this->parentObject == NULL && $this->database)
        {
            $p = $this->database->table(Tables::SUBMENU)->where('submenu', $this->id)->fetch();
            $factory = new \Blacklist\Factory\MenuFactory($this->database);
            if(isset($p->menu)){
                $this->parentObject = $factory->getById($p->menu);
            }
            unset($factory);
        }
        return $this->parentObject;
    }
    
    /**
     * @return type int
     */
    public function getParent()
    {
        $p = $this->database->table(Tables::SUBMENU)->where('submenu', $this->id)->fetch();
        return (isset($p->menu) ? $p->menu : 0);
    }
    
    /**
     * @param type $parent boolean
     */
    public function setParent($parent)
    {
        $this->parent = (int) $parent;
        $this->submenu = ($parent === 0) ? 0 : 1;
    }
    
    /**
     * 
     * @param type $index
     */
    public function setParentIndex($index)
    {
        $this->parentIndex = $index;
    }
    
    /**
     * 
     * @return type
     */
    public function getParentIndex()
    {
        return $this->parentIndex;
    }
    
    /**
     * @param \Blacklist\Object\MenuObject $menu
     */
    public function addSubMenu(MenuObject $menu)
    {
        $this->submenus[] = $menu;
    }
    
    /**
     * @return type 
     */
    public function getSubmenus()
    {
        return (array) Arrays::sortByKeyDESC($this->submenus);
    }

    /**
     * destroy all instances that are no longer needed
     */
    public function __destruct()
    {
        unset($this->submenus);
        unset($this->parentObject);
    }
}
