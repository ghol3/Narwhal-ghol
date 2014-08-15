<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 05.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Panel
 */
    
namespace
    Blacklist\Component\Panel;
    
use
    Nette\Application\UI\Form;
    
/**
 * This class is just Blacklist component 
 * with form for adding any page.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class NewPanelForm extends Form
{
    
    /**
     * This is the constructor of this class. Just initialize component.
     * 
     * @param type $ctgs \Blacklist\Model\Category\CategoryAction
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
	$this->addText('name', 'Jméno:');
	$this->addText('icon', 'Ikona:');
	$this->addTextArea('content', 'obsah:');
	$this->addSelect('position', 'pozice:', array('R'=>'Pravý', 'L' => 'Levý', 'B' => 'Spodní', 'T' => 'Horní'));
	$this->addText('priority', 'priorita:');
	$this->addCheckbox('visibility', 'Viditelnost')->setDefaultValue(1);
	$this->addSubmit('send', 'Vytvořit');
    }
}