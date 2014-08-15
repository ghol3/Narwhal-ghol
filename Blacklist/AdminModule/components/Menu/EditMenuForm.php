<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 28.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Menu
 */
    
namespace
    Blacklist\Component\Menu;
    
use
    Nette\Application\UI\Form,
    Blacklist\Object\MenuObject,
    Blacklist\Factory\MenuFactory;
    
/**
 * This class is just Blacklist component 
 * with form for editing any menu.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class EditMenuForm extends Form
{
    /**
     * Instance of menu action model.
     * 
     * @var type \Blacklist\Model\Menu\MenuAction
     */
    private $menus = NULL;
        
    /**
     * 
     * @param type $menus \Blacklist\Model\Menu\MenuAction
     * @param \Blacklist\Model\Menu\MenuControl $menu
     */
    public function __construct($menus, MenuObject $menu)
    {
        parent::__construct();
        $this->menus = $menus;
        $this->init($menu);
    }
        
    /**
     * This method just initialize the component form.
     */
    private function init(MenuObject $menu)
    {
        $this->addText('name', MENU_NAME_LABEL)
            ->setRequired(STR_615)
            ->addRule(Form::MIN_LENGTH, STR_616, 4)
            ->addRule(FOrm::MAX_LENGTH, STR_617, 40);

        $this->addText('link', MENU_URL_LABEL)
                ->addCondition(Form::FILLED)
                ->addRule(~Form::EQUAL, STR_618, $this->getValidateMenuLinks($menu->link));

        $this->addTextArea('description', MENU_DESCRIPTION_LABEL);

        $this->addUpload('image', MENU_IMAGE_LABEL)
            ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, STR_607); 
	
        $this->addSelect('parent', MENU_PARENT_LABEL, $this->getMenuArray($menu->id))
            ->setDefaultValue($menu->getParent());
	
        $this->addCheckbox('visibility', MENU_VISIBILITY_LABEL);        
        $this->addSubmit('send', MENU_SUBMIT_VALUE_EDIT);
        $this->addHidden('id', $menu->id);
        $this->setDefaults($menu->toArray());
    }
    
    /**
     * This method returns menus like array.
     * 
     * @return type \Blacklist\Model\Menu\MenuControl
     */
    private function getMenuArray($menuId)
    {
	$allMenusArray = array('0' => MENU_NO_PARENT);
        foreach($this->menus as $menuItem)
        {
            if($menuItem->id != $menuId)
            {
                $allMenusArray[$menuItem->id] = $menuItem->name;
            }
        }
	return $allMenusArray;
    }
    
    /**
     * 
     * @return type
     */
    private function getValidateMenuLinks($correct)
    {
        $array = array();
        foreach($this->menus as $menuItem)
        {
            if($menuItem->link != $correct){
                $array[] = $menuItem->link;
            }
        }
        return $array;
    }
    
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
	unset($this->menus);
    }
}