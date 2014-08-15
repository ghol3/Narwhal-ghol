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
    Blacklist\Model\Category\CategoryAction,
    Blacklist\Model\Page\PageControl;
    
/**
 * This class is just Blacklist component 
 * with form for editing any page.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class EditPageForm extends Form
{
    /**
     * Instance of category action model.
     * 
     * @var type \Blacklist\Model\Category\CategoryAction
     */
    private $categories = NULL;
        
    /**
     * 
     * @param \Blacklist\Model\Category\CategoryAction $ctgs
     * @param \Blacklist\Model\Page\PageControl $page
     */
    public function __construct($ctgs, \Blacklist\Object\PageObject $page, $pages)
    {
        parent::__construct();
        $this->categories = $ctgs;
        $this->init($page, $pages);
    }
        
    /**
     * This method just initialize the component form.
     */
    private function init(\Blacklist\Object\PageObject $page, $pages)
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
            ->addRule(~Form::EQUAL, STR_622, $this->getValidateLinks($pages, $page->link));
            
        $this->addSelect('category', PAGE_CATEGORY_LABEL, $this->getCategoryArray());
        $this->addHidden('author', $page->authorObject->id);
        $this->addTextArea('description', PAGE_DESCRIPTION_LABEL);
        $this->addTextArea('content', PAGE_CONTENT_LABEL);
        $this->addCheckbox('visibility', PAGE_VISIBILITY_LABEL);
        $this->addCheckbox('enableViews', PAGE_ENABLE_VIEWS_LABEL);
        $this->addCheckbox('enableScore', PAGE_ENABLE_SCORE_LABEL);
        $this->addCheckbox('enableComments', PAGE_ENABLE_COMMENTS_LABEL);     
        $this->addSubmit('send', PAGE_SUBMIT_VALUE_EDIT);
        $this->addHidden('id', $page->id);
        $this->setDefaults($page->toArray());
        $tags = '';
        foreach($page->getTags() as $tag){
            $tags = $tags . ' ' . $tag->tag;
        }
        $this->addText('tags', 'Tags:')
                ->setDefaultValue($tags);
    }
    
    /**
     * 
     * @param type $pages
     * @param type $correct
     * @return type
     */
    private function getValidateLinks($pages, $correct)
    {
        $array = array();
        foreach($pages as $page){
            if($page->link != $correct){
                $array[] = $page->link;
            }
        }
        return $array;
    }
    
    /**
     * This method returns category controls like array.
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