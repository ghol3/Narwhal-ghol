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
class EditTaskForm extends Form
{
    
    /**
     * This is the constructor of this class. Just initialize component.
     * 
     * @param type $ctgs \Blacklist\Model\Category\CategoryAction
     */
    public function __construct($userId, \Blacklist\Object\TaskObject $task)
    {
        parent::__construct();
        $this->init($userId, $task);
    }
    
    /**
     * This method just initialize the component form.
     */
    private function init($userId, \Blacklist\Object\TaskObject $task)
    {
	$this->addText('name', 'Název')
                ->setRequired(STR_627)
                ->setDefaultValue($task->name);
        
        $this->addHidden('author', $userId);
        $this->addHidden('id', $task->id);
        
        $this->addSelect('type', 'Typ:', array(
            'Fixnutí chyby'     => 'Fixnutí chyby',
            'Návrh na zlepšení' => 'Návrh na zlepšení',
            'Spěchá'            => 'Spěchá'
        ))->setDefaultValue($task->type);
        
        $this->addSelect('status', 'Status:', array(
            'Hotovo'        => 'Hotovo',
            'Rozpracované'  => 'Rozpracované',
            'Nové'          => 'Nové',
            'Čeká na kontrolu' => 'Čeká na kontrolu'
        ))->setDefaultValue($task->status);
        
        $this->addTextArea('content', 'Obsah')
                ->setDefaultValue($task->content);
        
        $this->addTextArea('comment', 'Komentář')
                ->setDefaultValue($task->comment);
        $this->addUpload('image', 'screenshot')
                ->setDefaultValue($task->image)
            ->addCondition(Form::FILLED)
            ->addRule(Form::IMAGE, STR_607);
        $this->addSubmit('send', 'Odeslat');
    }
}