<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 28.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Category
 */
    
namespace
    Blacklist\Component\Category;
    
use
    Nette\Application\UI\Form,
    Blacklist\Model\Category\CategoryAction;
    
/**
 * This class is package of one menu form.
 * @author Томас Петр <www.beepvix.com>
 */
class NewCategoryForm extends Form
{
    private $categories = NULL;
    
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     */
    public function __construct($ctgs)
    {
        parent::__construct();
	$this->categories = $ctgs;
        $this->init();
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init()
    {
        $this->addText('name', CTG_NAME_LABEL)
            ->setRequired(STR_608)
            ->addRule(Form::MIN_LENGTH, STR_609, 5)
            ->addRule(Form::MAX_LENGTH, STR_610, 50);

	$this->addSelect('parent', 'Otec.', $this->getCtgArray())
            ->setDefaultValue(0);
        
        $this->addText('link', 'adresa')
            ->setRequired(STR_613)
            ->addRule(Form::MIN_LENGTH, STR_611, 5)
            ->addRule(Form::MAX_LENGTH, STR_612, 100)
            ->addCondition(Form::FILLED)
            ->addRule(~Form::EQUAL, STR_614, $this->getValidateLinks());
	
        $this->addTextArea('description', CTG_DESCRIPTION_LABEL);
        $this->addCheckbox('visibility', CTG_VISIBLE_LABEL);  
        $this->addSubmit('send', CTG_SUBMIT_VALUE_ADD);
    }
    
    /**
     * 
     * @return type
     */
    private function getValidateLinks()
    {
        $array = array();
        foreach($this->categories as $ctg){
            $array[] = $ctg->link;
        }
        return $array;
    }
    
    /**
     * 
     * @return type
     */
    private function getCtgArray()
    {
	$allCtgsArray = array('0' => MENU_NO_PARENT);
        foreach($this->categories as $ctgItem)
        {
            $allCtgsArray[$ctgItem->id] = $ctgItem->name;
        }
	return $allCtgsArray;
    }
}