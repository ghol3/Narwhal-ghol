<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 16.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\FrontModule\Presenters
 */

namespace 
    Blacklist\FrontModule\Presenters;

use
    Nette,
    Nette\Database\Context,
    Nette\Mail\SendmailMailer,
    Nette\Mail\Message;

/**
 * @author Томас Петр
 */
class PagePresenter extends BasePresenter
{
    
    /**
     *
     * @var type 
     */
    private $pageFactory = NULL;
    
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
        $this->database = $db;
        parent::__construct($db);
    }
    
    /**
     *
     *
     */
    public function startup()
    {
        parent::startup();
        $this->defaultInit($this->database, $this->template);
        $this->pageFactory = new \Blacklist\Factory\PageFactory($this->database);
    }
    
    /**
     * 
     * @param type $url
     */
    public function renderShow($url)
    {
        $page = $this->pageFactory->getByUrl($url);
        
        if($page->title == NULL){
            $this->redirect('Error:default');
            return;
        }
        
        $menuF = new \Blacklist\Factory\MenuFactory($this->database);
        $pageURL = $menuF->getByUrl($url);
        if($pageURL->getParent() == 0){
            $this->template->activePage = $url;
        }else{
            $this->template->activePage = $pageURL->getParentObject()->link;
        }
        $page->score = ($page->score + 1);
        $page->setDatabase($this->database);
        $page->update();
        
        $this->template->page = $page;
        
        $articleFactory = new \Blacklist\Factory\ArticleFactory($this->database);
        $this->template->pages = $this->pageFactory->getAll();
        $this->template->articles = $articleFactory->getAll(5, 'category != 11');
    }
    
    /**
     * 
     * @return type
     */
    protected function createComponentCommentForm()
    {
        $form = new \Blacklist\Component\Comment\CommentComponentFactory($this->database, $this);
        $article = $this->pageFactory->getByUrl($this->getParameter('url'));
        return $form->getNewPageCommentForm($article->id, $this->getUser()->id);
    }
    
    /**
     * 
     * @param type $score
     * @param type $page
     */
    public function handleScoring($score, $page)
    {
        $page = $this->pageFactory->getById($page);
        $page->setDatabase($this->database);
        $page->evaluate($score);
        
        if($this->isAjax()){
            $this->redrawControl('scoring');
        }
    }
    
    /**
     * 
     * @return \Nette\Application\UI\Form
     */
    protected function createComponentCntactForm()
    {
        $form = new Nette\Application\UI\Form;
        $form->addText('username', 'Jméno')->setRequired(STR_691);
        $form->addText('email', 'Email')->setRequired(STR_692);
        $form->addText('phone', 'Telefon')->setRequired(STR_693);
        $form->addText('subject', 'Subjekt')
                ->setRequired(STR_694);
        $form->addTextArea('body', 'telo')
                ->setRequired(STR_695);
        $form->addSubmit('send', 'odeslat');
        $form->onSuccess[] = $this->cntrformsubmitted;
        return $form;
    }
    
    /**
     * 
     * @param Nette\Application\UI\Form $form
     */
    public function cntrformsubmitted(Nette\Application\UI\Form $form)
    {
        $settA = new \Blacklist\Model\Settings\SettingsAction($this->database);
        $basic = $settA->getBasicSettings();
        $data = $form->getValues();
        $mail = new Message;
        $mail->setFrom($data->username . ' <' . $data->email . '>')
            ->addTo($basic->site_email)
            ->setSubject($data->subject . '; tel - ' . $data->phone)
            ->setBody($data->body);

        $mailer = new SendmailMailer;
        $mailer->send($mail);
        
        $this->redirect('Homepage:default');
    }
}