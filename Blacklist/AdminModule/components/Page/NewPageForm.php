<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 28.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Page
 */
    
namespace
    Blacklist\Component\Page;
    
use
    Nette\Application\UI\Form,
    Blacklist\Factory\PageFactory;
    
/**
 * This class is just Blacklist component 
 * with form for adding any page.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class NewPageForm extends Form
{
    /**
     * Instance of category action model.
     * 
     * @var type \Blacklist\Model\Category\CategoryAction
     */
    private $categories = NULL;
    
    /**
     * This is the constructor of this class. Just initialize component.
     * 
     * @param type $ctgs \Blacklist\Model\Category\CategoryAction
     */
    public function __construct($ctgs, $userId, $pages)
    {
        parent::__construct();
        $this->categories = $ctgs;
        $this->init($userId, $pages);
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init($userId, $pages)
    {
        $this->addText('title', PAGE_TITLE_LABEL)
            ->setRequired(STR_619)
            ->addRule(Form::MIN_LENGTH, STR_620, 4)
            ->addRule(Form::MAX_LENGTH, STR_621, 50);

        $this->addText('link', PAGE_URL_LABEL)
            ->setRequired(STR_613)
            ->addRule(Form::MIN_LENGTH, STR_604, 5)
            ->addRule(Form::MAX_LENGTH, STR_605, 100)
            ->addCondition(Form::FILLED)
            ->addRule(~Form::EQUAL, STR_622, $this->getValidateLinks($pages));

        $this->addSelect('category', PAGE_CATEGORY_LABEL, $this->getCategoryArray());
        $this->addHidden('author', $userId); 
        $this->addTextArea('description', PAGE_DESCRIPTION_LABEL);
        $this->addTextArea('content', PAGE_CONTENT_LABEL);
        $this->addCheckbox('visibility', PAGE_VISIBILITY_LABEL);
        $this->addCheckbox('enableViews', PAGE_ENABLE_VIEWS_LABEL);
        $this->addCheckbox('enableScore', PAGE_ENABLE_SCORE_LABEL);
        $this->addCheckbox('enableComments', PAGE_ENABLE_COMMENTS_LABEL);
        $this->addText('tags', 'Tags:');
        $this->addSubmit('send', PAGE_SUBMIT_VALUE_ADD);
    }
    
    /**
     * 
     * @param type $pages
     * @return type
     */
    private function getValidateLinks($pages)
    {
        $array = array();
        foreach($pages as $page){
            $array[] = $page->link;
        }
        return $array;
    }
    
    /**
     * This method returns categories like array.
     * 
     * @return type \Blacklist\Model\Category\CategoryControl
     */
    private function getCategoryArray()
    {
	$selectCategories = array();
        foreach($this->categories as $category){
            $selectCategories[$category->id] = $category->name;
        }
	return $selectCategories;
    }
}