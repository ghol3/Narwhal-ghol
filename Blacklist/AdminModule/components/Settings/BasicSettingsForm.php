<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 05.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Settings
 */
    
namespace
    Blacklist\Component\Settings;
    
use
    Nette\Application\UI\Form,
    Blacklist\Model\Settings\BasicSettingsControl;
    
/**
 * This class is just Blacklist component 
 * with form for editing any page.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class BasicSettingsForm extends Form
{        
    /**
     * 
     * @param \Blacklist\Model\Category\CategoryAction $ctgs
     * @param \Blacklist\Model\Page\PageControl $page
     */
    public function __construct(\Blacklist\Object\BasicSettingsObject $basic)
    {
        parent::__construct();
        $this->init($basic);
    }
        
    /**
     * This method just initialize the component form.
     */
    private function init(\Blacklist\Object\BasicSettingsObject $basic)
    {
	$this->addText('site_url', 'Adresa stránky:')
		->setDefaultValue($basic->siteurl);
        $this->addText('title', 'Titulek:')
                ->setDefaultValue($basic->title);
	$this->addText('site_name', 'Název webu:')
		->setDefaultValue($basic->sitename);
	$this->addTextArea('sitedescription', 'Popis webu:')
		->setDefaultValue($basic->sitedescription);
	$this->addCheckbox('users_can_register', 'Jsou povolené registrace?')
		->setDefaultValue($basic->users_can_register);
	$this->addText('site_email', 'E-mailová adresa:')
		->setDefaultValue($basic->site_email);
	$this->addCheckbox('use_smiles', 'Měnit znaky smajlíků na obrázky?')
		->setDefaultValue($basic->site_smiles);
	$this->addCheckbox('require_registration_email', 'Vyžadovat ověření emailem po registraci?')
		->setDefaultValue($basic->require_registration_email);
        $this->addText('copyright', 'Copyright:')
                ->setDefaultValue($basic->copyright);
        $this->addTextArea('social', 'Sociální sítě:')
                ->setDefaultValue($basic->social);
        $this->addTextArea('footer', 'Footer:')
                ->setDefaultValue($basic->footer);
        $this->addText('phone', 'Telefon:')
                ->setDefaultValue($basic->phone);
        $this->addText('pagination', 'počet článků na stránku:')
                ->setDefaultValue($basic->pagination);
        $this->addCheckbox('comment_only_user', 'Komenáře pouze pro registrované?')
                ->setDefaultValue($basic->comment_only_user);
        $this->addText('username', 'Jméno majitele')
                ->setDefaultValue($basic->username);
        $this->addText('surname', 'Příjmení majitele')
                ->setDefaultValue($basic->surname);
	$this->addSubmit('send', 'Uložit změny');
        $this->addText('log_number', 'log_number')->setDefaultValue($basic->log_number);
        $this->addTextArea('keywords', 'Klíčová slova')->setDefaultValue($basic->keywords);
    }
}