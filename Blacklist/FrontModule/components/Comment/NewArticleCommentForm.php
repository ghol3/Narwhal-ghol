<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 28.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Comment
 */
    
namespace
    Blacklist\Component\Comment;
    
use
    Nette\Application\UI\Form;
    
/**
 * This class is just Blacklist component 
 * with form for adding any article comment.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class NewArticleCommentForm extends Form
{   
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     */
    public function __construct($articleId)
    {
        parent::__construct();
        $this->init($articleId);
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init($articleId, $author = NULL)
    {
        $this->addTextArea('content', CMNT_CONTENT_LABEL)
            ->setRequired(CMNT_CONTENT_REQ);
        $this->addHidden('author', ($author == NULL) ? 0 : $author);
        $this->addHidden('article', $articleId);
        $this->addSubmit('send', CMNT_SUBMIT_VALUE_ADD);
    }
}