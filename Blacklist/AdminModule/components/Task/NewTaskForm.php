<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 29.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Task
 */
    
namespace
    Blacklist\Component\Task;
    
use
    Nette\Application\UI\Form;
    
/**
 * This class is just Blacklist component 
 * with form for adding any page.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class NewTaskForm extends Form
{
    
    /**
     * This is the constructor of this class. Just initialize component.
     * 
     * @param type $ctgs \Blacklist\Model\Category\CategoryAction
     */
    public function __construct($userId)
    {
        parent::__construct();
        $this->init($userId);
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init($userId)
    {
	$this->addText('name', 'Název')
                ->setRequired(STR_627);
        $this->addHidden('author', $userId);
        $this->addSelect('type', 'Status', array(
            'Fixnutí chyby'     => 'Fixnutí chyby',
            'Návrh na zlepšení' => 'Návrh na zlepšení',
            'Spěchá'            => 'Spěchá'
        ));
        $this->addCheckbox('phone', 'Upozornit SMSkou')
                ->setDefaultValue(0);
        $this->addCheckbox('email', 'Upozornit na E-mail')
                ->setDefaultValue(1);
        $this->addTextArea('content', 'Obsah');
        $this->addTextArea('comment', 'Komentář');
        $this->addUpload('image', 'screenshot')
            ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, STR_607);
        $this->addSubmit('send', 'Odeslat');
    }
}