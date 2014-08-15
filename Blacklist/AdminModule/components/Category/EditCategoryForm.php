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
    Blacklist\Object\CategoryObject,
    Nette\Application\UI\Form,
    Blacklist\Factory\CategoryFactory;
    
/**
 * This class is just Blacklist component 
 * with form for editing any category.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class EditCategoryForm extends Form
{    
    private $categories = NULL;
    
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     * 
     * @param \Blacklist\Model\Category\CategoryControl $category
     */
    public function __construct(CategoryObject $category, $categories)
    {
        parent::__construct();
	$this->categories = $categories;
        $this->init($category);
    }
    
    /**
     * This method just initialize the component form.
     * 
     * @param \Blacklist\Model\Category\CategoryControl $category
     */
    private function init(CategoryObject $category)
    {
        $this->addText('name', CTG_NAME_LABEL)
            ->setRequired(STR_608)
            ->addRule(Form::MIN_LENGTH, STR_609, 5)
            ->addRule(Form::MAX_LENGTH, STR_610, 50);
        
        $this->addTextArea('description', CTG_DESCRIPTION_LABEL);
        $this->addCheckbox('visibility', CTG_VISIBLE_LABEL);
        $this->addHidden('id', $category->id);
        
	$this->addSelect('parent', 'otec:', $this->getCategoryArray($category->id))
            ->setDefaultValue(($category->getParentObject()->id !== '') ? $category->getParentObject()->id : 0);
	$this->addText('link', 'adresa')
            ->setRequired(STR_613)
            ->addRule(Form::MIN_LENGTH, STR_611, 5)
            ->addRule(Form::MAX_LENGTH, STR_612, 100)
            ->addCondition(Form::FILLED)
            ->addRule(~Form::EQUAL, STR_614, $this->getValidateLinks($category->link));
        $this->addSubmit('send', CTG_SUBMIT_VALUE_EDIT);
        $this->setDefaults($category->toArray());
    }
    
    /**
     * 
     * @param type $correct
     * @return type
     */
    private function getValidateLinks($correct)
    {
        $array = array();
        foreach($this->categories as $ctg){
            if($ctg->link != $correct){
                $array[] = $ctg->link;
            }
        }
        return $array;
    }
    
    /**
     * 
     * @param type $ctgId
     * @return type
     */
    private function getCategoryArray($ctgId)
    {
	$allCtgsArray = array('0' => MENU_NO_PARENT);
        foreach($this->categories as $ctgItem)
        {
            if($ctgItem->id != $ctgId)
            {
                $allCtgsArray[$ctgItem->id] = $ctgItem->name;
            }
        }
	return $allCtgsArray;
    }
}