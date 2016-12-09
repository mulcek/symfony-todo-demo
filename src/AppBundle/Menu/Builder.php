<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Home', array('route' => 'task_index'));
        
        $menu->addChild('Tasks', array('route' => 'task_index'))
			->setAttribute('icon', 'fa fa-list');
        $menu['Tasks']->addChild('New task', array('route' => 'task_new'));
        
        $menu->addChild('Users', array('route' => 'user_index'))
			->setAttribute('icon', 'fa fa-group');
        $menu['Users']->addChild('New user', array('route' => 'user_new'));

//        // access services from the container!
//        $em = $this->container->get('doctrine')->getManager();
//        // findMostRecent and Blog are just imaginary examples
//        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();
//
//        $menu->addChild('Latest Blog Post', array(
//            'route' => 'blog_show',
//            'routeParameters' => array('id' => $blog->getId())
//        ));
//
//        // create another menu item
//        $menu->addChild('About Me', array('route' => 'about'));
//        // you can also add sub level's to your menu's as follows
//        $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

        return $menu;
    }
    
//    public function userMenu(FactoryInterface $factory, array $options)
//    {
//    	$menu = $factory->createItem('root');
//    	$menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
//    	/*
//    	You probably want to show user specific information such as the username here. That's possible! Use any of the below methods to do this.
//    	if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {} // Check if the visitor has any authenticated roles
//    	$username = $this->container->get('security.context')->getToken()->getUser()->getUsername(); // Get username of the current logged in user
//    	*/	
//		$menu->addChild('User', array('label' => 'Hi visitor'))
//			->setAttribute('dropdown', true)
//			->setAttribute('icon', 'fa fa-user');
//		$menu['User']->addChild('Edit profile', array('route' => 'acme_hello_profile'))
//			->setAttribute('icon', 'fa fa-edit');
//        return $menu;
//    }
}