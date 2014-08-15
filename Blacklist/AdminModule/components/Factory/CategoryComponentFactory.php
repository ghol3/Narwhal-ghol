<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 15.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Category
 */

namespace 
    Blacklist\Component\Category;
    
use
    Nette\Database\Context,
    Nette\Object as NObject,
    Blacklist\Model\Category\CategoryAction;

/**
 * This class is component factory for
 * category components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class CategoryComponentFactory extends NObject
{
    /**
     * Instance of any presenter for redirecting and
     * flash message.
     * 
     * @var type 
     */
    private $presenter = NULL;
    
    /**
     * Instance of category action class.
     * 
     * @var type App\Model\Category\CategoryAction
     */
    private $categories = NULL;
    
    /**
     *
     * @var type 
     */
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
        $this->presenter = $presenter;
        $this->database = $db;
        $this->categories = new \Blacklist\Factory\CategoryFactory($db);
    }
    
    /**
     * This method returns category component
     * for adding new categories.
     * 
     * @return \Blacklist\Component\Category\NewCategoryForm
     */
    public function getNewCategoryForm()
    {
        $form = new NewCategoryForm($this->categories->getAll());
        $form->onSuccess[] = $this->newCategoryFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns category component
     * for editing categories by primary key.
     * 
     * @param type $categoryId INTEGER (primary key)
     * @return \Blacklist\Component\Category\EditCategoryForm
     */
    public function getEditCategoryForm($categoryId)
    {
        $form = new EditCategoryForm($this->categories->getById($categoryId), $this->categories->getAll());
        $form->onSuccess[] = $this->editCategoryFormSubmitted;
        return $form;
    }
    
    /**
     * This method is event for new category form component.
     * Just add any category into my database.
     * 
     * @param \Blacklist\Component\Category\NewCategoryForm $form
     */
    public function newCategoryFormSubmitted(NewCategoryForm $form)
    {
        $category = new \Blacklist\Object\CategoryObject(NULL);
        $data = $form->getValues();
        $category->setParent($data->parent);
        unset($data->parent);
        $category->make($data);
        $category->setDatabase($this->database);
        $category->create();
        $this->presenter->flashMessage(STR_14 .' "'. $category->name . '" ' . STR_528, 'success');
        $this->presenter->redirect('Category:default');
    }
    
    /**
     * This method is event for edit category form component.
     * Just edit any category in my database by primary key id.
     * 
     * @param \Blacklist\Component\Category\EditCategoryForm $form
     */
    public function editCategoryFormSubmitted(EditCategoryForm $form)
    {
        
        $category = new \Blacklist\Object\CategoryObject(NULL);
        $data = $form->getValues();
        $category->setParent($data->parent);
        unset($data->parent);
        $category->make($data);
        $category->setDatabase($this->database);
        $category->update();
        $this->presenter->flashMessage(STR_14 . ' <a target="_blank" href="/produkty/'.$category->link.'">"' . $category->name . '"</a> ' . STR_530, 'success');
	    $this->presenter->redirect('this');
    }
    
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
	    unset($this->categories);
    }
}