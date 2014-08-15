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
class ArticleComponentFactory extends NObject
{
    /**
     * Instance of article action class.
     * 
     * @var type Blacklist\Model\Article\ArticleAction
     */
    private $articles = NULL;
    
    /**
     * Instance of category action class.
     * 
     * @var type App\Model\Category\CategoryAction
     */
    private $categories = NULL;
    
    /**
     * Instance of any presenter for redirecting and
     * flash message.
     * 
     * @var type 
     */
    private $presenter = NULL;
    
    /**
     *
     * @var type 
     */
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
        $this->articles     = new AFactory($db);
        $this->categories   = new CategoryFactory($db);
        $this->presenter    = $presenter;
        $this->database = $db;
    }
    
    /**
     * This method returns article component for adding 
     * new article into database.
     * 
     * @return \Blacklist\Component\Article\NewArticleForm
     */
    public function getNewArticleForm($userId)
    {
        $factory = new AFactory($this->database);
        $form = new NewArticleForm($this->categories->getAll(), $userId, $factory->getAll());
        $form->onSuccess[] = $this->newArticleFormSubmitted;
        return $form;
    }
    
    /**
     * This method returns article component for editing
     * any article in my database.
     * 
     * @param type $articleId INTEGER
     * @return \Blacklist\Component\Article\EditArticleForm
     */
    public function getEditArticleForm($articleId)
    {
        $factory = new AFactory($this->database);
	$form = new EditArticleForm
	(
	    $this->categories->getAll(), 
	    $this->articles->getById($articleId),
            $factory->getAll()
	);
        $form->onSuccess[] = $this->editArticleFormSubmitted;
        return $form;
    }
    
    /**
     * This method is event for new article component
     * -> add a new article into my database using article
     * models.
     * 
     * @param \Blacklist\Component\Article\NewArticleForm $form
     */
    public function newArticleFormSubmitted(NewArticleForm $form)
    {
        $article = new \Blacklist\Object\ArticleObject(NULL, NULL, NULL, NULL);
        $data = $form->getValues();
        $dataTags = $data->tags;
        unset($data->tags);
        $article->make($data);
        $article->setDatabase($this->database);
        
        $imageFactory = new \Blacklist\Object\ImageFactory($article->image);
        $imageFactory->upload('images/clanky/');
        
        $article->image = ($imageFactory->path . $imageFactory->name);
        if($article->visibility){$article->visibility = 1;}
        if($article->enableScore){$article->enableScore = 1;}
        if($article->enableComments){$article->enableComments = 1;}
        $article->create(TRUE);
        
        foreach(explode(' ', $dataTags) as $myTag){
            $tag = new \Blacklist\Object\TagObject($myTag);
            $tag->article = $article->id;
            $tag->setDatabase($this->database);
            $tag->create();
        }
        $this->presenter->flashMessage(STR_434 . ' "' . $article->title . '" '. STR_451, 'success');
        $this->presenter->redirect('Article:default');
    }
    
    /**
     * This method is event for edit article component
     * -> edit any article in my database... using article
     * models. 
     * 
     * @param \Blacklist\Component\Article\EditArticleForm $form
     */
    public function editArticleFormSubmitted(EditArticleForm $form)
    {
        $article = new \Blacklist\Object\ArticleObject(NULL, NULL, NULL, NULL);
        $data = $form->getValues();
        $dataTags = $data->tags;
        unset($data->tags);
        $article->make($data);
        $article->setDatabase($this->database);
       
        
        if($article->image->getName() != NULL)
        {
            $imageFactory = new \Blacklist\Object\ImageFactory($article->image);
            $imageFactory->upload('images/clanky/');
            $article->image = ($imageFactory->path . $imageFactory->name);
        }
        
        if($article->visibility){$article->visibility = 1;}
        if($article->enableScore){$article->enableScore = 1;}
        if($article->enableComments){$article->enableComments = 1;}
        $article->update();
        $article->removeTags();
        
        foreach(explode(' ', $dataTags) as $myTag){
            $tag = new \Blacklist\Object\TagObject($myTag);
            $tag->article = $article->id;
            $tag->setDatabase($this->database);
            $tag->create();
        }
        $this->presenter->flashMessage(STR_434 . ' <a target="_blank" href="/informacie-o-antiradaroch/'. $article->link . '">"' . $article->title . '"</a> '. STR_523, 'success');
        $this->presenter->redirect('this');
    }
    
    /**
     * This method cleans up the class.
     */
    public function __destruct()
    {
        unset($this->articles);
        unset($this->categories);
    }
}