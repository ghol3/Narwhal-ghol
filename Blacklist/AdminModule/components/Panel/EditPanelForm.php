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
    Nette\Application\UI\Form,
    Blacklist\Object\PanelObject;
    
/**
 * This class is just Blacklist component 
 * with form for editing any page.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class EditPanelForm extends Form
{
    
    /**
     * This is the constructor of this class. Just initialize component.
     * 
     * @param type $ctgs \Blacklist\Model\Category\CategoryAction
     */
    public function __construct(PanelObject $p)
    {
        parent::__construct();
        $this->init($p);
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init(PanelObject $p)
    {
	$this->addText('name', 'Jméno:')
		->setDefaultValue($p->name);
	$this->addText('icon', 'Ikona:')
		->setDefaultValue($p->icon);
	$this->addTextArea('content', 'obsah:')
		->setDefaultValue($p->content);
	$this->addSelect('position', 'pozice:', array('R'=>'Pravý', 'L' => 'Levý', 'B' => 'Spodní', 'T' => 'Horní'))
		->setDefaultValue($p->position);
	$this->addText('priority', 'priorita:')
		->setDefaultValue($p->priority);
	$this->addCheckbox('visibility', 'Viditelnost')
		->setDefaultValue($p->visibility);
	$this->addHidden('id', $p->id);
	$this->addSubmit('send', 'Uložit změny!');
    }
}