<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 21.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Module
 */
    
namespace
    Blacklist\Component\Module;
    
use
    Nette\Application\UI\Form;
    
/**
 * This class is package of one menu form.
 * @author Томас Петр <www.beepvix.com>
 */
class NewModuleFormZip extends Form
{
    
    /**
     * This is the constructor of this class. 
     * Just initialize component.
     * 
     * @param type $menus \Blacklist\Model\Menu\MenuAction
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
        $this->addUpload('zip', ART_IMAGE_LABEL)
            ->addCondition(Form::FILLED)
            ->addRule(Form::MIME_TYPE, 'Musí být zip', 'application/zip')
            ->addRule(Form::MAX_FILE_SIZE, 'uhuhu', 5000 * 1024); // 500 kB
        
        $this->addSubmit('send');
    }
}