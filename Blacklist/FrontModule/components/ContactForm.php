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
    Nette\Application\UI\Form;
    
/**
 * This class is just Blacklist component 
 * with form for contact us.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class ContactForm extends Form
{
    
    /**
     * This is the constructor of this class. J
     * ust initialize component.
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init()
    {
        $this->addText('name', 'Name')
                ->setAttribute('placeholder', 'Name')
                ->setRequired('Prosím, vyplňte jméno.');
        
        
        $this->addText('email', 'Email')
                ->setAttribute('placeholder', 'Email')
                ->setRequired('Prosím, vyplńte Vaši emailovou adresu.')
                ->addRule(Form::EMAIL, 'Tato hodnota musí být emailová adresa.');
        
        $this->addTextArea('content', 'Your message')
                ->setAttribute('placeholder', 'Your message')
                ->setRequired('Prosím, vyplňte obsah zprávy.');
        $this->addSubmit('send', 'Send message');
    }
}