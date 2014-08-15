<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 20.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component
 */

namespace
    Blacklist\Component;

use
    Blacklist\Component\ContactForm,
    Nette\Database\Context,
    Nette\Mail\Message,
    Nette\Mail\SendmailMailer;

/**
 * This class is component factory for
 * article components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class ComponentFactory extends \Nette\Object
{
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
        $this->presenter    = $presenter;
        $this->database = $db;
    }
    
    public function getContactForm()
    {
        $form = new ContactForm();
        $form->onSuccess[] = $this->contactFormSubmitted;
        return $form;
    }
    
    public function contactFormSubmitted(ContactForm $form)
    {   
        $data = $form->getValues();
        
        $mail = new Message;
        $mail->setFrom($data->name . ' <' . $data->email . '>')
            ->addTo($this->presenter->template->settings->site_email)
            ->setSubject('Zpráva z OKpokuty.cz')
            ->setBody($data->content);
        
        $mailer = new SendmailMailer;
        $mailer->send($mail);
        
        $this->presenter->flashMessage('Vaše zpráva byla doručena, děkujeme.');
        
        if($this->presenter->isAjax()){
            $this->presenter->redrawControl('contact');
        }else{
            $this->presenter->redirect('this');
        }
    }
}