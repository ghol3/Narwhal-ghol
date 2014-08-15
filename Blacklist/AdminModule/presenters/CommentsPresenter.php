<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 04.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\AdminModule\Presenters
 */

namespace 
    Blacklist\AdminModule\Presenters;

use
    Nette,
    Nette\Database\Context,
    Blacklist\Model\Comment\CommentAction;

/**
 * @author Томас Петр
 */
class CommentsPresenter extends BasePresenter
{
    private $comments = NULL;
    /**
     * This is the constructor of this class just set the
     * database context from Nette to my parent.
     * 
     * @param Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
	parent::__construct();
	$this->comments = new CommentAction($db);
    }
    
    /**
     *
     *
     */
    public function startup()
    {
        parent::startup();
	$this->template->user = $this->getUser();
    }
    
    protected function createComponentEditform()
    {
	//return $this->component->getEditArticleForm($this->getParameter('id'));
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
	$this->template->comments = $this->comments->getCollection();
    }
    
    /**
     * 
     * @param type $id
     */
    public function renderShow($id)
    {
	$this->template->comment = $this->comments->getById($id);
    }
    
    public function renderAdd()
    {
	
    }
    
    protected function createComponentAddform()
    {
	//return $this->component->getNewArticleForm($this->getUser()->getId());
    }
    
    public function handlePublish($id)
    {
	$comment = $this->comments->getById($id);
	$comment->setStatus(1);
	$this->comments->update($comment);
	$this->redirect('this');
    }
    
    public function handleSpam($id)
    {
	$comment = $this->comments->getById($id);
	$comment->setStatus(2);
	$this->comments->update($comment);
	$this->redirect('this');
    }
    
    public function handleBan($id)
    {
	$comment = $this->comments->getById($id);
	$comment->setStatus(3);
	$this->comments->update($comment);
	$this->redirect('this');
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
	$this->comments->remove($id);
    }
}