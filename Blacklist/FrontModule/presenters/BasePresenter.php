<?php

namespace Blacklist\FrontModule\Presenters;

use 
    Nette,
    Blacklist\Model\Settings\SettingsAction;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    public $activePage = 'homepage';
    /**
     *
     * @var type 
     */
    private $database = NULL;
    
    /**
     * 
     * @param \Nette\Database\Context $db
     */
    public function __construct(\Nette\Database\Context $db)
    {
        $this->database = $db;
        parent::__construct();
    }
    
    /**
     * 
     * @param \Nette\Database\Context $db
     * @param type $template
     */
    protected function defaultInit(\Nette\Database\Context $db, $template)
    {
        $menuF = new \Blacklist\Factory\MenuFactory($db);
        $settings = new SettingsAction($db);
        $panels = new \Blacklist\Factory\PanelFactory($db);
        $categoryF = new \Blacklist\Factory\CategoryFactory($db);
        $articleF = new \Blacklist\Factory\ArticleFactory($db);
        
        $template->bottom = $panels->getBottom();
        $template->right  = $panels->getRight();
        $template->settings = $settings->getBasicSettings();
        $template->menu = $menuF->getVisible();
        $template->categories = $categoryF->getAll();
        $template->myArticles = $articleF->getAll(3);
        $template->allarticles = $articleF->getAll();
        $widgetsF = new \Blacklist\Object\WidgetFactory($this->database);
        $template->widgets = $widgetsF->getAll();
        $template->activePage = $this->activePage;
    }

    /**
     * 
     * @return type
     */
    protected function createComponentContactForm()
    {
        $this->defaultInit($this->database, $this->template);
        $components = new \Blacklist\Component\ComponentFactory($this->database, $this);
        return $components->getContactForm();
    }
    
    /**
     * 
     * @return type
     */
    public function commentFormIsCorrect()
    {
        return (($this->template->settings->comment_only_user && $this->getUser()->isLoggedIn()) || !$this->template->settings->comment_only_user);
    }
}
