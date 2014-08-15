<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 21.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\AdminModule\Presenters
 */

namespace 
    Blacklist\AdminModule\Presenters;

use
    Nette,
    Nette\Database\Context;
use ZipArchive;

/**
 * @author Томас Петр
 */
class ModulePresenter extends BasePresenter
{   
    
    private $factory = NULL;
    
    private $database;
    
    /**
     * This is the constructor of this class just set the
     * database context from Nette to my parent.
     * 
     * @param Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
        $this->factory = new \Blacklist\Factory\ModuleFactory($db);
        parent::__construct();
        $this->database = $db;
    }
    
    /**
     *
     *
     */
    public function startup()
    {
        parent::startup();
        $this->template->user = $this->getUser();
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
        $this->template->modules = $this->factory->getAll();
    }
    
    protected function createComponentUploadForm()
    {
        $form = new \Blacklist\Component\Module\NewModuleFormZip();
        $form->onSuccess[] = $this->submitted;
        return $form;
    }
    
    public function submitted(\Blacklist\Component\Module\NewModuleFormZip $form)
    {
        $values = $form->getValues();
        $zip = new ZipArchive;
        if ($zip->open($values->zip) === TRUE) {
            $name = $values->zip->name;
            $name = str_replace('.zip', '', $name);
            $zip->extractTo('modules/');
            $zip->close();
            
            require_once ('modules/' . $name . '/loader.php');
            $class = '\Blacklist\Object\\' . $name;
            $module = new $class();
            
            $control = new \Blacklist\Object\ModuleObject($module->getName(), $module->getAuthor(), $module->getVersion());
            $control->active = 0;
            $control->date = $module->getDate();
            $control->description = $module->getDescription();
            $control->setDatabase($this->database);
            $control->key = $module->getKey();
            $control->create();
            
            $router = $module->getRouter();
          
            $models = $router['Models'];
            $templates = $router['Templates'];
            
            copy('modules/' . $control->key . '/' . $router['AdminPresenter'], __DIR__ . '/' . $control->key . 'Presenter.php');
            copy('modules/' . $control->key . '/' . $router['FrontPresenter'], __DIR__ . '/../../FrontModule/Presenters/' . $control->key . 'Presenter.php');
            
            $this->database->table('prefix_module_files')->insert(array('pkey' => $control->key, 'file' => __DIR__ . '/' . $control->key . 'Presenter.php'));
            $this->database->table('prefix_module_files')->insert(array('pkey' => $control->key, 'file' => __DIR__ . '/../../FrontModule/Presenters/' . $control->key . 'Presenter.php'));
            
            foreach($models as $key => $value){
                if(!file_exists(__DIR__ . '/../../models/' . $control->key)){
                    mkdir(__DIR__ . '/../../models/' . $control->key);
                }
                $this->database->table('prefix_module_files')->insert(array('pkey' => $control->key, 'file' => __DIR__ . '/../../models/' . $control->key . '/' . $control->key . $key . '.php'));
                copy('modules/' . $control->key . '/'. $value, __DIR__ . '/../../models/' . $control->key . '/' . $control->key . $key . '.php');  
                 
            }
            
            foreach($templates as $key => $value){
                if(!file_exists(__DIR__ . '/../templates/' . $control->key)){
                    mkdir(__DIR__ . '/../templates/' . $control->key);
                }
                $this->database->table('prefix_module_files')->insert(array('pkey' => $control->key, 'file' => __DIR__ . '/../templates/' . $control->key . '/' . $key . '.latte'));
                copy('modules/' . $control->key . '/' . $value, __DIR__ . '/../templates/' . $control->key . '/' . $key . '.latte');
            }
            //$this->database->table('prefix_module_files')->insert(array('pkey' => $control->key, 'file' => __DIR__ . '/../../models/' . $control->key));
            $this->database->query($module->getDatabaseQuery());
            unset($control);
            
            echo 'ok';
        } else {
            echo 'failed';
        }
    }
    
    public function handleDelete($id)
    {
        $key = $this->database->table(\Blacklist\Model\String\TableString::MODULES)->get($id);
        $files = $this->database->table('prefix_module_files')->where('pkey', $key->key);
        foreach($files as $file){
            unlink($file->file);
            $this->database->table('prefix_module_files')->where('id', $file->id)->delete();
        }
        $this->database->table('prefix_modules')->where('id', $id)->delete();
    }
}