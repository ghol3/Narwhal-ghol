<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 * 
 * @date 07.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\Menu
 */

namespace 
    Blacklist\Factory;

use 
    Nette\Database\Context as Connection,
    Blacklist\Model\String\TableString as Tables,
    Blacklist\Object\MenuObject;

/**
 * This class is used to model the menu. 
 * Represents events for classic menu model.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class MenuFactory
{
    /**
     * This is the database connection by Nette framework.
     * 
     * @var type \Nette\Database\Context
     */
    private $database = NULL;
    
    /**
     * This is constructor of MenuAction class. Just save the
     * database context instance into private variable.
     * 
     * @param \Nette\Database\Context $db
     */
    public function __construct(Connection $db)
    {
        $this->database = $db;
    }
    
    /**
     * This method returns just one menu item from the database
     * by primary key id.
     * 
     * @param type $id int (primary key)
     * @return \Blacklist\Object\MenuObject
     */
    public function getById($id)
    {
        $menuItem = $this->database->table(Tables::MENU)->get($id);
        $menuObject = new MenuObject(NULL, NULL);
        if(isset($menuItem->id)){
            $menuObject->make($menuItem);
            $menuObject->setDatabase($this->database);
            $this->fillSubItems($menuObject);
        }
        
        return $menuObject;
    }
    
    /**
     * 
     * @param type $url
     * @return type
     */
    public function getByUrl($url)
    {
        $menuItem = $this->database->table(Tables::MENU)
            ->where('link', $url)->fetch();
        
        $menuObject = new MenuObject(NULL, NULL);
        $menuObject->setDatabase($this->database);
        if(isset($menuItem->id)){
            $menuObject->make($menuItem);
            $this->fillSubItems($menuObject);
        }
        return $menuObject;
    }
    
    /**
     * This method returns all menu items from the database.
     * 
     * @return \Blacklist\Model\Menu\MenuControl
     */
    public function getAll()
    {
        $menuItems = $this->database->table(Tables::MENU)
                ->order('priority');
        $mObjects = array();
        foreach($menuItems as $menuItem)
        {
            $item = new MenuObject(NULL, NULL);
            $item->make($menuItem);
            
            $this->fillSubItems($item);
            $item->setDatabase($this->database);
            $mObjects[] = $item;
        }
        return $mObjects;
    }
    
    /**
     * This method returns all menu items but just where
     * visibility is binary true...
     * 
     * @return \Blacklist\Object\MenuObject
     */
    public function getVisible()
    {
        $menuItems = $this->database->table(Tables::MENU)
            ->where(array('visibility' => '1', 'submenu' => 0))
            ->order('priority');
        $mObjects = array();
        foreach($menuItems as $menuItem)
        {
            $item = new MenuObject(NULL, NULL);
            $item->make($menuItem);
            $this->fillSubItems($item, 'yep');
            $item->setDatabase($this->database);
            $mObjects[] = $item;
        }
        return $mObjects;
    }
    
    /**
     * This method returns array of database objects by menu id.
     * 
     * @param type $item int (primary key)
     * @return type database object
     */
    private function fillSubItems(MenuObject $item, $visibility = NULL)
    {
        // getting submenus for this menu
        $submenus = $this->database->table(Tables::SUBMENU)
            ->where('menu', $item->id);
        // add submenu into my menu
        foreach($submenus as $submenu)
        {
            if($visibility !== NULL){
                $mItem = $this->database->table(Tables::MENU)
                        ->where(array('visibility' => '1', 'id' => $submenu->submenu))->fetch();

                if(isset($mItem->name)){
                    $myItem = new MenuObject(NULL, NULL);
                    $myItem->make($submenu);
                    $myItem->setParent($item->id);
                    $myItem->setDatabase($this->database);
                    $myItem->make($mItem);
                    $item->addSubmenu($myItem);
                }
            }else{
                    $mItem = $this->database->table(Tables::MENU)
                        ->get($submenu->submenu);

                    $myItem = new MenuObject(NULL, NULL);
                    $myItem->make($submenu);
                    $myItem->setParent($item->id);
                    $myItem->setDatabase($this->database);
                    $myItem->make($mItem);
                    $item->addSubmenu($myItem);
            }
        }
        // recursive searching for submenu -> submenu ^^
        foreach($item->getSubmenus() as $subItem)
        {
            $this->fillSubItems($subItem, ($visibility != NULL)? 'sadsa' : NULL);
        }
    }
    
    /**
     * 
     * @param type $menus
     */
    private function getControlArray($menus)
    {
        $aControls = array();
        foreach($menus as $menu)
        {
            $control = new MenuObject(NULL, NULL);
            $control->setDatabase($this->database);
            $control->make($menu);
            $this->fillSubItems($control);
            $aControls[] = $control;
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
    
    private $tree = array();
    
    /**
     * 
     * @return type
     */
    public function getTree()
    {
        $categories = $this->database->table(Tables::MENU)
                ->where('submenu', 0)
                ->order('priority');
        $fillCtgs = $this->getControlArray($categories);
        foreach($fillCtgs as $category)
        {
            $category->setParentIndex(0);
            $this->tree[] = $category;
            if(count($category->getSubmenus()) > 0){
                $this->getAllSubMenus($category, 1);
            }
        }
        return $this->tree;
    }
    
    /**
     * 
     * @param type $menu
     * @param type $index
     */
    private function getAllSubMenus($menu, $index)
    {
        foreach($menu->getSubmenus() as $cat)
        {
            $cat->setParentIndex($index);
            $this->tree[] = $cat;
            $this->getAllSubMenus($cat, ($index + 1));
        }
    }
    
    /**
     * 
     * @param type $priority
     * @param type $visibility
     * @param type $parent
     */
    public function updateAll($priority, $visibility, $parent)
    {
        foreach($priority as $key => $value){
            $this->database->table(Tables::MENU)
                    ->where('id', $key)
                    ->update(array('priority' => $value, 'visibility' => (isset($visibility[$key]) && $visibility[$key]) ? 1 : 0));
        }
        
        foreach($parent as $key => $value){
            $this->database->table(Tables::SUBMENU)
                    ->where('submenu', $key)
                    ->delete();
            
            if($value !== '' || $value != 0){
                $this->database->table(Tables::SUBMENU)
                        ->insert(array('submenu' => $key, 'menu' => $value));
                $this->database->table(Tables::MENU)
                        ->where('id', $key)
                        ->update(array('submenu' => 1));
            }else{
                $this->database->table(Tables::MENU)
                        ->where('id', $key)
                        ->update(array('submenu' => 0));
            }
        }
    }
}