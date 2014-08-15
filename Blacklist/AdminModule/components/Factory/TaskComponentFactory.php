<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 26.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Component\Article
 */

namespace
    Blacklist\Component\Article;

use
    Blacklist\Factory\ArticleFactory as AFactory,
    Blacklist\Factory\CategoryFactory,
    Nette\Object as NObject,
    Nette\Database\Context;

/**
 * This class is component factory for
 * article components.
 * 
 * @author Томас Петр <www.beepvix.com>
 */
class TaskComponentFactory extends NObject
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
    
    /**
     * 
     * @param type $userId
     * @return \Blacklist\Component\Task\NewTaskForm
     */
    public function getNewTaskForm($userId)
    {
        $form = new \Blacklist\Component\Task\NewTaskForm($userId);
        $form->onSuccess[] = $this->newTaskFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param type $userId
     * @param type $taskId
     * @return \Blacklist\Component\Task\EditTaskForm
     */
    public function getEditTaskForm($userId, $taskId)
    {
        $factory = new \Blacklist\Factory\TaskFactory($this->database);
        $form = new \Blacklist\Component\Task\EditTaskForm($userId, $factory->getById($taskId));
        $form->onSuccess[] = $this->editTaskFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param \Blacklist\Component\Task\EditTaskForm $form
     */
    public function editTaskFormSubmitted(\Blacklist\Component\Task\EditTaskForm $form)
    {
        $data = $form->getValues();
        $taskObject = new \Blacklist\Object\TaskObject(NULL, NULL, NULL);
        unset($data->author);    
        $taskObject->make($data);
        
        if($taskObject->image->getName() != NULL)
        {
            $imageFactory = new \Blacklist\Object\ImageFactory($taskObject->image);
            $imageFactory->upload('tasks/');
            $taskObject->image = ($imageFactory->path . $imageFactory->name);
        }
        $taskObject->done = $this->presenter->getUser()->id;
        $taskObject->setDatabase($this->database);
        $taskObject->update();
        $this->presenter->flashMessage(STR_507 . ' "' . $data->name . '" ' . STR_523, 'success');
        $this->presenter->redirect('Task:default');
    }
    
    /**
     * 
     * @param \Blacklist\Component\Task\NewTaskForm $form
     */
    public function newTaskFormSubmitted(\Blacklist\Component\Task\NewTaskForm $form)
    {
        $data = $form->getValues();
        $taskObject = new \Blacklist\Object\TaskObject(NULL, NULL, NULL);
        $taskObject->make($data);
        $taskObject->phone = $data->phone ? 'y' : 'n';
        $taskObject->email = $data->email ? 'y' : 'n';
        $taskObject->setDatabase($this->database);
        
        $imageFactory = new \Blacklist\Object\ImageFactory($taskObject->image);
        $imageFactory->upload('tasks/');
        $taskObject->image = ($imageFactory->path . $imageFactory->name);
        
        $taskObject->create();
        
        if($taskObject->phone == 'y' || $taskObject->email == 'y')
        {
            $mail = new \Nette\Mail\Message;
        
            $mail->setFrom('Aktivita na Antiradary.sk <antiradary@web.sk>');
            if($taskObject->phone == 'y'){
                $mail->addTo('winitrix@vodafonemail.cz');
            }
            if($taskObject->email == 'y'){
                $mail->addTo('tomas.petr@bk.ru');
            }
            $mail->setSubject('Aktivita na Antiradary.sk')
                    ->setHTMLBody('V práci vám zadali nový úkol - '. $data->content . ', krásný den.');
        
            $mailer = new \Nette\Mail\SendmailMailer;
            $mailer->send($mail);
        }

        $this->presenter->flashMessage(STR_507 . ' "' . $taskObject->name . '" '.STR_451, 'success');
        $this->presenter->redirect('Task:default');
    }
    
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {

    }
}