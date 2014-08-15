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
    Nette\Application\UI\Form,
    Blacklist\Model\Comment\PageComment as Comment;
    
/**
 * This class is just Blacklist component 
 * with form for editing any page comment.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class EditPageCommentForm extends Form
{
    
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     */
    public function __construct(Comment $comment)
    {
        parent::__construct();
        $this->init($comment);
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init(Comment $comment)
    {
        $this->addTextArea('content', CMNT_CONTENT_LABEL)
            ->setRequired(CMNT_CONTENT_REQ);
        $this->addHidden('author', 1);
        $this->addHidden('page', $comment->getPage());
        $this->addHidden('id', $comment->getId());
        $this->addSubmit('send', CMNT_SUBMIT_VALUE_EDIT);
        $this->setDefaults($comment->getArray());
    }
}