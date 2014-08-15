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
    Nette\Database\Context,
    Blacklist\Factory\PageFactory,
    Blacklist\Factory\CategoryFactory;
    
/**
 * This class is component factory for
 * page components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class PageComponentFactory extends \Nette\Object
{
    /**
     * Instance of page action class.
     *
     * @param type \Blacklist\Model\Page\PageAction
     */
    private $pages = NULL;
        
    /**
     * Instance of category action class.
     *
     * @param type \Blacklist\Model\Category\CategoryAction
     */
    private $categories = NULL;
    
    /**
     * Instance of any presenter for messages & redirecting.
     *
     * var type 
     */
    private $presenter = NULL;
    
    private $database = NULL;
    
    /**
     * Constructor of this class, set database connection 
     * like private and load the presenter + default init.
     * 
     * @param \Nette\Database\Context $db
     * @param type $presenter
     */
    public function __construct(Context $db, $presenter)
    {
        $this->pages        = new PageFactory($db);
        $this->categories   = new CategoryFactory($db);
        $this->presenter    = $presenter;
        $this->database = $db;
    }
    
    /**
     * This method returns page component for adding 
     * new page into my database.
     * 
     * @return \Blacklist\Component\Page\NewPageForm
     */
    public function getNewPageForm()
    {
        $form = new NewPageForm($this->categories->getAll(), $this->presenter->getUser()->getId(), $this->pages->getAll());
        $form->onSuccess[] = $this->newPageFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns page component for editing
     * any page in my database by primary key.
     * 
     * @param type $pageId INTEGER (primary key)
     * @return \Blacklist\Component\Page\EditPageForm
     */
    public function getEditPageForm($pageId)
    {
        $form = new EditPageForm($this->categories->getAll(), $this->pages->getById($pageId), $this->pages->getAll());
        $form->onSuccess[] = $this->editPageFormSubmitted;
        return $form;
    }
    
    /**
     * This method is event for new page form component.
     * Just add a new page into my database.
     * 
     * @param \Blacklist\Component\Page\NewPageForm $form
     */
    public function newPageFormSubmitted(NewPageForm $form)
    {
        $page = new \Blacklist\Object\PageObject(NULL, NULL, NULL, NULL);
        $data = $form->getValues();
        $dataTags = $data->tags;
        unset($data->tags);
        $page->make($data);
        $page->setDatabase($this->database);
        if($page->visibility){$page->visibility = 1;}
        if($page->enableScore){$page->enableScore = 1;}
        if($page->enableComments){$page->enableComments = 1;}
        
        foreach(explode(' ', $dataTags) as $myTag){
            $tag = new \Blacklist\Object\TagObject($myTag);
            $tag->page = $page->id;
            $tag->setDatabase($this->database);
            $tag->create();
        }
        
        $page->create(TRUE);
        $this->presenter->flashMessage(MSG_NEW_PAGE_SUCCESS, 'success');
	    $this->presenter->redirect('Page:default');
    }
    
    /**
     * This method is event for edit page form component.
     * Just edit any page in my database by primary key.
     * 
     * @param \Blacklist\Component\Page\EditPageForm $form
     */
    public function editPageFormSubmitted(EditPageForm $form)
    {
        $page = new \Blacklist\Object\PageObject(NULL, NULL, NULL, NULL);
        $data = $form->getValues();
        $dataTags = $data->tags;
        unset($data->tags);
        $page->make($data);
        $page->setDatabase($this->database);
        if($page->visibility){$page->visibility = 1;}
        if($page->enableScore){$page->enableScore = 1;}
        if($page->enableComments){$page->enableComments = 1;}
        $page->update();
        $page->removeTags();
        
        foreach(explode(' ', $dataTags) as $myTag){
            $tag = new \Blacklist\Object\TagObject($myTag);
            $tag->page = $page->id;
            $tag->setDatabase($this->database);
            $tag->create();
        }

        $this->presenter->flashMessage(STR_535 . ' <a href="/' . $page->link . '/" target="_blank">"' . $page->title . '"</a> ' . STR_530, 'success');
	    $this->presenter->redirect('this');
    }
        
        
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
        unset($this->pages);
    }
}