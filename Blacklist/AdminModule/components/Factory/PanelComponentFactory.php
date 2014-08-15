<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 05.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Panel
 */
    
namespace
    Blacklist\Component\Panel;
    
use
    Nette\Database\Context,
    Blacklist\Factory\PanelFactory,
    Blacklist\Object\PanelObject,
    Blacklist\Component\Panel\NewPanelForm;
    
/**
 * This class is component factory for
 * panel components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class PanelComponentFactory extends \Nette\Object
{
    private $panels = NULL;
    /**
     * Instance of any presenter for messages & redirecting.
     *
     * var type 
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
	    $this->panels = new PanelFactory($db);
        $this->presenter    = $presenter;
        $this->database = $db;
    }
    
    /**
     * 
     * @return \Blacklist\Component\Panel\NewPanelForm
     */
    public function getNewPanelForm()
    {
        $form = new NewPanelForm();
        $form->onSuccess[] = $this->newPanelFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param type $id
     * @return \Blacklist\Component\Panel\EditPanelForm
     */
    public function getEditPanelForm($id)
    {
        $form = new EditPanelForm($this->panels->getById($id));
        $form->onSuccess[] = $this->editPanelFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param \Blacklist\Component\Panel\NewPanelForm $form
     */
    public function newPanelFormSubmitted(NewPanelForm $form)
    {
        $object = new PanelObject(NULL);
        $object->make($form->getValues());
        $object->setDatabase($this->database);
        $object->create();
        $this->presenter->flashMessage(STR_500 . ' "' . $object->name . '" ' . STR_451, 'success');
        $this->presenter->redirect('Panel:default');
    }
    
    /**
     * 
     * @param \Blacklist\Component\Panel\EditPanelForm $form
     */
    public function editPanelFormSubmitted(EditPanelForm $form)
    {
        $object = new PanelObject(NULL);
        $object->make($form->getValues());
        $object->setDatabase($this->database);
        $object->visibility = ($object->visibility) ? 1 : 0;
        $object->update();
	    $this->presenter->flashMessage(STR_500 . ' "' . $object->name . '" ' . STR_451, 'success');
	    $this->presenter->redirect('Panel:edit', $object->id);
    }
        
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
        unset($this->panels);
    }
}