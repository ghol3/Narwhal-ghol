<?php

namespace Blacklist;

use Nette,
    Nette\Application\Routers\RouteList,
    Nette\Application\Routers\Route,
    Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

    /**
     * @return \Nette\Application\IRouter
     */
    public function createRouter()
    {
        $router = new RouteList();
	
        $router[] = new Route('admin', array(
	    'module'	=> 'Admin',
	    'presenter'	=> 'Auth',
	    'action'	=> 'Login',
	    'id'	=> NULL
	));
        $router[] = new Route('new/dabel', 'Front:New:default');
        $router[] = new Route('new/cart', 'Front:New:cart');
        $router[] = new Route('new/product', 'Front:New:Product');
        $router[] = new Route('new/contact', 'Front:New:Contact');
        $router[] = new Route('new/showPage', 'Front:New:showPage');
        $router[] = new Route('new/showArticle', 'Front:New:showArticle');
        $router[] = new Route('new/showCategory', 'Front:New:showCategory');
        $router[] = new Route('new/showProduct', 'Front:New:showproduct');

	$router[] = new Route('admin/<presenter>/<action>/<id>', array(
	    'module'	=> 'Admin',
	    'presenter'	=> 'Homepage',
	    'action'	=> 'default',
	    'id'	=> NULL
	));

	$router[] = new Route('<presenter>/<action>/<id>', array(
	    'module'	=> 'Front',
	    'presenter'	=> 'Homepage',
	    'action'	=> 'default',
	    'id'	=> NULL
	));
        
        
        
	return $router;
    }

}
