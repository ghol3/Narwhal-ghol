<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 27.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Menu
 */
    
namespace
    Blacklist\Component\Menu;
    
use
    Nette\Object as NObject,
    Nette\Database\Context,
    Blacklist\Factory\MenuFactory,
    Blacklist\Object\MenuObject;

/**
 * This class is component factory for
 * menu components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class MenuComponentFactory extends NObject
{
    /**
     * Instance of menu action model.
     * 
     * @var type \Blacklist\Model\Menu\MenuAction
     */
    private $menus = NULL;
    
    /**
     * Instance of any presenter for redirecting and
     * flash message.
     * 
     * @var type 
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
        $this->menus        = new MenuFactory($db);
        $this->database     = $db;
        $this->presenter    = $presenter;
    }
    
    /**
     * This method returns menu component for adding
     * new menu item into my database.
     * 
     * @return \Blacklist\Component\Menu\NewMenuForm
     */
    public function getNewMenuForm()
    {
        $form = new NewMenuForm($this->menus->getAll());
        $form->onSuccess[] = $this->newMenuFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns menu component for editing
     * menu iten in my database by primary key.
     * 
     * @param type $menuId INTEGER (primary key)
     * @return \Blacklist\Component\Menu\EditMenuForm
     */
    public function getEditMenuForm($menuId)
    {
        $form = new EditMenuForm($this->menus->getAll(), $this->menus->getById($menuId));
        $form->onSuccess[] = $this->editMenuFormSubmitted;
        return $form;
    }
    
    /**
     * This method is event for new menu form component.
     * Just add a new menu item into my database using
     * menu models.
     * 
     * @param \Blacklist\Component\Menu\NewMenuForm $form
     */
    public function newMenuFormSubmitted(NewMenuForm $form)
    {   
        $menu = new MenuObject(NULL, NULL);
        $menu->make($form->getValues());

        $menu->setDatabase($this->database);
        
        $imageFactory = new \Blacklist\Object\ImageFactory($menu->image);
        $imageFactory->upload();
        
        $menu->image = ($imageFactory->path . $imageFactory->name);
        $menu->create();
        $this->presenter->flashMessage(STR_457 . ' ("' . $menu->name . '") ' . STR_528, 'success');
	    $this->presenter->redirect('Menu:default');
    }
    
    /**
     * This method is event for edit menu form component.
     * Just edit the menu iten in my database by primary key
     * id and using menu models.
     * 
     * @param \Blacklist\Component\Menu\EditMenuForm $form
     */
    public function editMenuFormSubmitted(EditMenuForm $form)
    {
        $menu = new MenuObject(NULL, NULL);
        $menu->make($form->getValues());
        $menu->setDatabase($this->database);
        
  
        
        $imageFactory = new \Blacklist\Object\ImageFactory($menu->image);
        $imageFactory->upload();
        $menu->image = ($imageFactory->path . $imageFactory->name);
        $menu->update();

        $this->presenter->flashMessage(STR_457.' ("' . $menu->name . '") '. STR_530, 'success');
	    $this->presenter->redirect('Menu:default');
    }
}