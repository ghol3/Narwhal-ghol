<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 27.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Comment
 */
    
namespace
    Blacklist\Component\Comment;
    
use
    Nette\Object as NObject,
    Nette\Database\Context,
    Blacklist\Model\Comment\CommentAction;

/**
 * This class is component factory for
 * article / page comment components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class CommentComponentFactory extends NObject
{
    /**
     * Instance of comment action class.
     * 
     * @param type \Blacklist\Model\Comment\CommentAction
     */
    private $comments = NULL;
    
    /**
     * Instance of any presenter for redirecting and
     * flash message.
     * 
     * @var type 
     */
    private $presenter = NULL;
    
    private $database;
    
    /**
     * Constructor of this class, set database connection 
     * like private and load the presenter + default init.
     * 
     * @param \Nette\Database\Context $db
     * @param type $presenter
     */
    public function __construct(Context $db, $presenter)
    {
        $this->comments = new \Blacklist\Factory\CommentFactory($db);
        $this->presenter = $presenter;
        $this->database = $db;
    }
    
    /**
     * This method returns comment component for adding
     * comments into any article.
     * 
     * @param type $articleId INTEGER (primary key)
     * @return \Blacklist\Component\Comment\NewArticleCommentForm
     */
    public function getNewArticleCommentForm($articleId, $userId)
    {
        $form = new NewArticleCommentForm($articleId, $userId);
        $form->onSuccess[] = $this->newArticleCommentFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns comment component for adding
     * comments into any page.
     * 
     * @param type $pageId INTEGER (primary key)
     * @return \Blacklist\Component\Comment\NewPageCommentForm
     */
    public function getNewPageCommentForm($pageId, $userId)
    {
        $form = new NewPageCommentForm($pageId, $userId);
        $form->onSuccess[] = $this->newPageCommentFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns comment component for editing
     * comment into any page by comment primary key.
     * 
     * @param type $commentId INTEGER (primary key)
     * @return \Blacklist\Component\Comment\EditPageCommentForm
     */
    public function getEditPageCommentForm($commentId)
    {
        $form = new EditPageCommentForm($this->comments->getById($commentId));
        $form->onSuccess[] = $this->editPageCommentFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns comment component for editing
     * comment into any article by comment primary key.
     * 
     * @param type $commentId INTEGER (primary key)
     * @return \Blacklist\Component\Comment\EditArticleCommentForm
     */
    public function getEditArticleCommentForm($commentId)
    {
        $form = new EditArticleCommentForm($this->comments->getById($commentId));
        $form->onSuccess[] = $this->editArticleCommentFormSubmitted;
        return $form;
    }
    
    /**
     * This method is event for new article comment form component.
     * Just add a new comment in article by primary key.
     * 
     * @param \Blacklist\Component\Comment\NewArticleCommentForm $form
     */
    public function newArticleCommentFormSubmitted(NewArticleCommentForm $form)
    {
        $commentObject = new \Blacklist\Object\CommentObject(NULL);
        $commentObject->make($form->getValues());
        $commentObject->setDatabase($this->database);
        $commentObject->create();
        
        $this->presenter->flashMessage('Komentář byl úspěšně přidán.', 'success');
        if($this->presenter->isAjax()){
            $this->presenter->redrawControl('comments');
        }else{
            $factory = new \Blacklist\Factory\ArticleFactory($this->database);
            $article = $factory->getById($form->getValues()->article);
            $this->presenter->redirect('Article:show', $article->link);
        }
    }
    
    /**
     * This method is event for new page comment form component.
     * Just edit any comment in page by primary key.
     * 
     * @param \Blacklist\Component\Comment\NewPageCommentForm $form
     */
    public function newPageCommentFormSubmitted(NewPageCommentForm $form)
    {
        $commentObject = new \Blacklist\Object\CommentObject(NULL);
        $commentObject->make($form->getValues());
        $commentObject->setDatabase($this->database);
        $commentObject->create();
        
        $this->presenter->flashMessage('Komentář byl úspěšně přidán.', 'success');
        if($this->presenter->isAjax()){
            $this->presenter->redrawControl('comments');
        }else{
            $factory = new \Blacklist\Factory\PageFactory($this->database);
            $page = $factory->getById($form->getValues()->page);
            $this->presenter->redirect('Page:show', $page->link);
        }
    }
    
    /**
     * This method is event for edit page comment form component.
     * Just edit some comment in any page by primary key.
     * 
     * @param \Blacklist\Component\Comment\EditPageCommentForm $form
     */
    public function editPageCommentFormSubmitted(EditPageCommentForm $form)
    {
        $comment = $this->comments->makeControl($form->getValues());
        $this->comments->update($comment);
        $this->presenter->flashMessage('Komentáč byl úspěšně editován!', 'success');
    }
    
   /**
    * This method is event for edit article comment form component.
    * Just edit some comment in any article by primary key.
    * 
    * @param \Blacklist\Component\Comment\EditArticleCommentForm $form
    */
    public function editArticleCommentFormSubmitted(EditArticleCommentForm $form)
    {
        $comment = $this->comments->makeControl($form->getValues());
        $this->comments->update($comment);
        $this->presenter->flashMessage('Komentář byl úspěšně editován!', 'success');
    }
    
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
        unset($this->comments);
    }
}