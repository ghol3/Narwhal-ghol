<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 03.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\FrontModule\Presenters
 */

namespace 
    Blacklist\FrontModule\Presenters;

use
    Nette,
    Nette\Database\Context,
    Nette\Application\UI\Form;

/**
 * @author Томас Петр
 */
class HomepagePresenter extends BasePresenter
{
    
    /**
     *
     * @var type 
     */
    private $component = NULL;
    
    /**
     *
     * @var type 
     */
    private $database = NULL;
    
    /**
     * This is the constructor of this class just set the
     * database context from Nette to my parent.
     * 
     * @param Nette\Database\Context $db
     */
    public function __construct(Context $db)
    {
        $this->database = $db;
        parent::__construct($db);
    }
    
    /**
     *
     *
     */
    public function startup()
    {
        parent::startup();
    }
    
    /**
     * 
     */
    public function renderCart()
    {
        $this->activePage = '';
        $this->defaultInit($this->database, $this->template);
    }
    
    /**
     * 
     */
    public function handleRemoveCart()
    {
        $cart = $this->getSession('cart');
        unset($cart->cart);
        $cart->cart = new \Blacklist\Object\Cart;
        
        if($this->isAjax()){
            $this->redrawControl('mycart');
        }
    }
    
    /**
     * This method just render the default page in 
     * my homepage...
     */
    public function renderDefault()
    {
        $this->activePage = 'homepage';
        $this->defaultInit($this->database, $this->template);
        
        $articles = new \Blacklist\Factory\ArticleFactory($this->database);
        
        $this->template->articles = $articles->getAll(3);
        $this->template->mainArticle = $articles->getByCategory(11);
        
        $mylatte = new \Latte\Engine;
        $mylatte->setLoader(new \Latte\Loaders\StringLoader);
        $this->template->latte = $mylatte;
    }
    
    /**
     * 
     */
    public function handleLogout()
    {
        $this->getUser()->logout();
        $this->redirect('Homepage:default');
    }
    
    /**
     * 
     * @param type $productID
     */
    public function handleRemoveItemFromCart($productID)
    {
        $session = $this->getSession('cart');
        $session->cart->remove($productID, true);
        
        if($this->isAjax()){
            $this->redrawControl('cart');
            $this->redrawControl('mycart');
        }
    }
    
    /**
     * 
     */
    public function renderOrder()
    {
        $this->activePage = '';
        $this->defaultInit($this->database, $this->template);
    }
    
    /**
     * 
     * @return \Nette\Application\UI\Form
     */
    protected function createComponentNewOrderForm()
    {
        $form = new Form;
        $form->addText('firm', 'Firma:');
        $form->addText('username', 'Meno:')
                ->setRequired('Prosím, vyplňte Vaše krstné meno.');
        $form->addText('surname', 'Priezvisko:')
                ->setRequired('Prosím, vyplňte Vaše priezvisko.');
        $form->addText('address', 'Ulica a Číslo:')
                ->setRequired('Prosím, vyplňte Vašu adresu a číslo bydliska.');
        $form->addText('city', 'Mesto:')
                ->setRequired('Prosím, vyplňte mesto, v ktorom bývate.');
        $form->addText('zip', 'PSČ:')
                ->setRequired('Prosím, vyplňte poštové smerovacie číslo.');
        $form->addText('phone', 'Telefon:')
                ->setRequired('Prosím, vyplňte Vaše telefónne číslo. Toto pole je povinné.');
        $form->addText('email', 'Email:')
                ->setRequired('Prosím, vyplňte Váš email, toto pole je povinné.');
        
        $payment = array(
            'K' => 'Kartou',
            'H' => 'Hotově',
            'P' => 'Převodem',
            'D' => 'Dobírkou'
        );
        $form->addRadioList('payment', 'Platba:', $payment)
                ->setDefaultValue('D');
        
        $form->addTextArea('note', '');
        
        $form->addText('ic', 'IČ:')
                ->addConditionOn($form['firm'], Form::FILLED)
                ->addRule(Form::FILLED, 'Zadali jste název firmy, zadejte prosím také hodnotu IČ.');
        $form->addText('dic', 'DIČ:')
                ->addConditionOn($form['firm'], Form::FILLED)
                ->addRule(Form::FILLED, 'Zadali jste název firmy, zadejte prosím také hodnotu DIČ.');
        
        $form->addSubmit('send', 'odeslat');        
        $form->onSuccess[] = $this->newOrderFormSubmitted;
        return $form;
    }
    
    /**
     * 
     * @param \Nette\Application\UI\Form $form
     */
    public function newOrderFormSubmitted(Form $form)
    {
        $data = $form->getValues();
        $sessions = $this->getSession('data');
        $sessions->data = array
        (
            'firm'      => $data->firm,
            'username'  => $data->username,
            'surname'   => $data->surname,
            'address'   => $data->address,
            'city'      => $data->city,
            'zip'       => $data->zip,
            'phone'     => $data->phone,
            'email'     => $data->email,
            'payment'   => $data->payment,
            'note'      => $data->note,
            'ic'        => $data->ic,
            'dic'       => $data->dic
        );
        
        $this->redirect('Homepage:check');
    }
    
    public function handleDoneOrder()
    {
        $settings = new \Blacklist\Model\Settings\SettingsAction($this->database);
        $eshopsettings = $settings->getEshopSettings();
        $eshopsettings->last_order = $eshopsettings->last_order + 1;
        $settings->updateEshopSettings($eshopsettings);
        
        $sessionsd = $this->getSession('data');
        $data = $sessionsd->data;
        
        $order = new \Blacklist\Object\OrderObject($eshopsettings->last_order . '/' . date("Y"), 
                $data['username'], $data['surname'], $data['address'], $data['city'], 
                $data['email'], $data['phone'], 'sk', 'PPL', 'D', 
                'antiradary.sk', 'sk', '€');
        $order->zip = $data['zip'];
        $order->deliveryPrice = 0;
        if($data['firm'] != '' && $data['ic'] != '' && $data['dic'] != '')
        {
            $order->firm = $data['firm'];
            $order->ico = $data['ic'];
            $order->dic = $data['dic'];
            $order->firm_address = $data['address'];
            $order->firm_city = $data['city'];
            $order->firm_zip = $data['zip'];
        }
        $order->status = 'new';
        $order->country = 'Slovenská republika';
        $order->payment = $data['payment'];
        $order->facture_lang = $eshopsettings->default_language;
        $order->setDatabase($this->database);
        $order->create();
        
        $orderF = new \Blacklist\Factory\OrderFactory($this->database);
        $myorder = $orderF->getByCode($eshopsettings->last_order . '/' . date("Y"));
        
        $sessions = $this->getSession('cart');
        foreach($sessions->cart->getProducts() as $product)
        {
            $orderProduct = new \Blacklist\Object\OrderProductsObject($myorder->id, $product->product, $product->count);
            $orderProduct->code = $product->code;
            $orderProduct->discount = 0;
            $orderProduct->name = $product->name;
            $orderProduct->price = $product->price;
            $orderProduct->pricedph = $product->pricedph;
            $orderProduct->setDatabase($this->database);
            $orderProduct->orderkey = $myorder->id;
            $orderProduct->create();
        }
        
        $this->redirect('Homepage:thanks');
    }

    /**
     *
     */
    public function renderCheck()
    {
        $this->activePage = '';
        $this->defaultInit($this->database, $this->template);
        $sessions = $this->getSession('data');
        $this->template->mydata = $sessions->data;
    }
    
    /**
     * 
     */
    public function renderConditions()
    {
        $this->defaultInit($this->database, $this->template);
        $settings = new \Blacklist\Model\Settings\SettingsAction($this->database);
        $es = $settings->getEshopSettings();
        $this->template->conditions = $es->conditions;
    }
    
    /**
     * 
     */
    public function handleUpdateCart()
    {
        $data = $_POST;
        $sessions = $this->getSession('cart');
        
        foreach($data['count'] as $key => $value)
        {
            if($value < 1){ $value = 1; }
            $sessions->cart->change($key, $value);
        }
        if($this->isAjax())
        {
            $this->redrawControl('cart');
            $this->redrawControl('mycart');
        }
    }
    
    /**
     * 
     */
    public function renderThanks()
    {
        $sessions = $this->getSession('cart');
        if(count($sessions->cart->getProducts()) === 0){
            $this->redirect('Error:404');
            return;
        }
        $sessions->cart->removeAll();
        $this->defaultInit($this->database, $this->template);
        $settings = new \Blacklist\Model\Settings\SettingsAction($this->database);
        $this->template->page = $settings->getEshopSettings()->thanks;
    }
    
    /**
     * 
     */
    public function renderResetOrderToDefault()
    {
        $settings = new \Blacklist\Model\Settings\SettingsAction($this->database);
        $es = $settings->getEshopSettings();
        $es->last_order = $es->order_number;
        $settings->updateEshopSettings($es);
        $this->redirect('Homepage:default');
    }
}