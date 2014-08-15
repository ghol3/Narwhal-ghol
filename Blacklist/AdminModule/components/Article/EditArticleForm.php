<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 28.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Article
 */
    
namespace
    Blacklist\Component\Article;
    
use
    Blacklist\Model\Category\CategoryAction as Categories,
    Blacklist\Model\Article\ArticleControl as Control,
    Nette\Application\UI\Form;
    
/**
 * This class is just Blacklist component 
 * with form for editing any article.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class EditArticleForm extends Form
{
    
    /**
     * Instance of category action model.
     *
     * @var type 
     */
    private $categories = NULL;
    
    /**
     * This is the constructor of this class. Just initialize component.
     * 
     * @param  
     * @param \Blacklist\Model\Article\ArticleControl $article
     */
    public function __construct($categories, \Blacklist\Object\ArticleObject $article, $articles)
    {
        parent::__construct();
        $this->categories = $categories;
        $this->init($article, $articles);
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init(\Blacklist\Object\ArticleObject $article, $articles)
    {
        $this->addText('title', ART_TITLE_LABEL)
            ->setRequired(STR_600)
            ->addRule(Form::MIN_LENGTH, STR_601, 5)
            ->addRule(Form::MAX_LENGTH, STR_602, 100);
	
        $this->addText('link', ART_LINK_LABEL)
                ->setRequired(STR_603)
                ->addRule(Form::MIN_LENGTH, STR_604, 5)
                ->addRule(Form::MAX_LENGTH, STR_605, 100)
                ->addCondition(Form::FILLED)
                ->addRule(~Form::EQUAL, STR_606 , $this->getValidateLinks($articles, $article->link));
	
        $this->addTextArea('description', ART_DESCRIPTION_LABEL);
        $this->addTextArea('content', ART_CONTENT_LABEL);
        $this->addUpload('image', ART_IMAGE_LABEL)
            ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, STR_607); // 500 kB
        
	$this->addCheckbox('enableScore', ART_ENABLE_SCORE_LABEL);
        $this->addCheckbox('enableViews', ART_ENABLE_VIEWS_LABEL);
        $this->addCheckbox('enableComments', ART_ENABLE_COMMENTS_LABEL);
        $this->addCheckbox('visibility', ART_VISIBLE_LABEL);
        $this->addHidden('id', $article->id);
        $this->addHidden('author', $article->authorObject->id);
	$this->addSelect('category', ART_CATEGORY_LABEL, $this->getCategoryArray())
		->setDefaultValue($article->categoryObject->id);
        
        $this->setDefaults($article->toArray());
        $tags = '';
        foreach($article->getTags() as $tag){
            $tags = $tags . ' ' . $tag->tag;
        }
        $this->addText('tags', 'Tags:')
                ->setDefaultValue($tags);
        $this->addSubmit('send' , ART_SUBMIT_VALUE_EDIT);
    }
    
    /**
     * 
     * @param type $articles
     * @return type
     */
    private function getValidateLinks($articles, $correct)
    {
        $array = array();
        foreach($articles as $article){
            if($article->link != $correct){
                $array[] = $article->link;
            }
        }
        return $array;
    }
    
    /**
     * This method returns array of categories.
     * 
     * @return type \Blacklist\Model\Category\CategoryControl array
     */
    private function getCategoryArray()
    {
	$ctgs = array();
        foreach($this->categories as $category){
            $ctgs[$category->id] = $category->name;
        }
	return $ctgs;
    }
}