<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 12.07.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\AdminModule\Presenters
 */

namespace 
    Blacklist\AdminModule\Presenters;

use
    Nette,
    Nette\Database\Context;

/**
 * @author Томас Петр
 */
class WidgetPresenter extends BasePresenter
{
    /**
     *
     * @var type 
     */
    private $database = NULL;
    
    /**
     * This is the constructor of this class just set the
     * database context from Nette to my parent.
     * 
     * @param Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
        parent::__construct();
        $this->database = $db;
    }
    
    /**
     * 
     */
    public function renderDefault()
    {
        $widgetF = new \Blacklist\Object\WidgetFactory($this->database);
        $this->template->widgets = $widgetF->getAll(true);
    }
    
    /**
     * 
     */
    public function renderEdit($widgetid)
    {
        $widgetF = new \Blacklist\Object\WidgetFactory($this->database);
        $this->template->widget = $widgetF->getById($widgetid);
    }
    
    /**
     * 
     */
    public function renderAdd()
    {
        
    }
    
    /**
     * 
     * @return \Nette\Application\UI\Form
     */
    protected function createComponentAddForm()
    {
        $form = new Nette\Application\UI\Form;
        $form->addText('name', 'Identifikátor')
                ->setRequired(STR_687);
        $form->addTextArea('content', 'Obsah widget:');
        $form->addText('class', 'CSS Třída:')
                ->setRequired(STR_686);
        $form->addSubmit('send', 'odeslat');
        $form->addSelect('type', 'Typ:', array('html' => 'HTML 5', 'php' => 'PHP 5.5', 'latte' => 'Nette\Latte'))
                ->setDefaultValue('html');
        $form->onSuccess[] = $this->addFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param \Nette\Application\UI\Form $form
     */
    public function addFormSubmitted(\Nette\Application\UI\Form $form)
    {
        $data = $form->getValues();
        $widget = new \Blacklist\Object\WidgetObject($data->name, $data->content);
        $widget->priority = 0;
        $widget->type = $data->type;
        $widget->user = $this->getUser()->id;
        $widget->visibility = 1;
        $widget->class = $data->class;
        $widget->setDatabase($this->database);
        $widget->create();
        
        $this->redirect('Widget:default');
    }
    
    /**
     * 
     * @param type $id
     */
    public function handleDelete($id)
    {
        $widgetF = new \Blacklist\Object\WidgetFactory($this->database);
        $widget = $widgetF->getById($id);
        $widget->remove();
        
        if($this->isAjax()){
            $this->redrawControl('widgets');
        }
    }
    
    /**
     * 
     * @return \Nette\Application\UI\Form
     */
    protected function createComponentEditForm()
    {
        $widgetf = new \Blacklist\Object\WidgetFactory($this->database);
        $widget = $widgetf->getById($this->getParameter('widgetid'));
        $form = new Nette\Application\UI\Form;
        $form->addText('name', 'Identifikátor')
                ->setDefaultValue($widget->name)
                ->setRequired(STR_687);
        $form->addTextArea('content', 'Obsah widget:')
                ->setDefaultValue($widget->content);
        $form->addText('class', 'CSS Třída:')
                ->setDefaultValue($widget->class)
                ->setRequired(STR_686);
        $form->addHidden('id', $widget->id);
        $form->addSubmit('send', 'odeslat');
        $form->addSelect('type', 'Typ:', array('html' => 'HTML 5', 'php' => 'PHP 5.5', 'latte' => 'Nette\Latte'))
                ->setDefaultValue($widget->type);
        $form->onSuccess[] = $this->editFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param \Nette\Application\UI\Form $form
     */
    public function editFormSubmitted(\Nette\Application\UI\Form $form)
    {
        $data = $form->getValues();
        $widgetf = new \Blacklist\Object\WidgetFactory($this->database);
        $mywidget = $widgetf->getById($data->id);
        $mywidget->make($data);
        $mywidget->update();
        
        $this->redirect('Widget:default');
    }
    
    /**
     * 
     */
    public function renderupdateAll()
    {
        $priority = isset($_POST['priority']) ? $_POST['priority'] : array();
        $visibility = isset($_POST['visibility']) ? $_POST['visibility'] : array();
        $factory = new \Blacklist\Object\WidgetFactory($this->database);
        
        foreach($priority as $key => $priority){
            $widget = $factory->getById($key);
            $widget->priority = $priority;
            if(isset($visibility[$key]) && $visibility[$key]){
                $widget->visibility = '1';
            }else{
                $widget->visibility = '0';
            }
            $widget->update();
        }
        
        $this->redirect('Widget:default');
    }
}