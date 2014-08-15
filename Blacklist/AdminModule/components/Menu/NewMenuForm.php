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
    Blacklist\Model\Menu\MenuAction;
    
/**
 * This class is package of one menu form.
 * @author Томас Петр <www.beepvix.com>
 */
class NewMenuForm extends Form
{
    
    private $menus = NULL;
    
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     * 
     * @param type $menus \Blacklist\Model\Menu\MenuAction
     */
    public function __construct($menus)
    {
        parent::__construct();
        $this->menus = $menus;
        $this->init();
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init()
    {
        $this->addText('name', MENU_NAME_LABEL)
            ->setRequired(STR_615)
            ->addRule(Form::MIN_LENGTH, STR_616, 4)
            ->addRule(FOrm::MAX_LENGTH, STR_617, 40);

        $this->addText('link', MENU_URL_LABEL)
                ->addCondition(Form::FILLED)
                ->addRule(~Form::EQUAL, STR_618, $this->getValidateMenuLinks());

	$this->addUpload('image', MENU_IMAGE_LABEL)
            ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, STR_607);
	
	$this->addSelect('parent', MENU_PARENT_LABEL, $this->getMenuArray())
            ->setDefaultValue(0);
	
        $this->addTextArea('description', MENU_DESCRIPTION_LABEL);
        $this->addCheckbox('visibility', MENU_VISIBILITY_LABEL);
        $this->addSubmit('send', MENU_SUBMIT_VALUE_ADD);
    }
    
    /**
     * 
     * @return type
     */
    private function getValidateMenuLinks()
    {
        $array = array();
        foreach($this->menus as $menuItem)
        {
            $array[] = $menuItem->link;
        }
        return $array;
    }
    
    /**
     * This method returns menus like array.
     * 
     * @return type \Blacklist\Model\Menu\MenuControl
     */
    private function getMenuArray()
    {
	$allMenusArray = array('0' => MENU_NO_PARENT);
        foreach($this->menus as $menuItem)
        {
            $allMenusArray[$menuItem->id] = $menuItem->name;
        }
	return $allMenusArray;
    }
}