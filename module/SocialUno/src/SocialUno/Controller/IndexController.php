<?php

namespace SocialUno\Controller;

use SocialUno\Controller\ActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class IndexController extends ActionController
{
    public function indexAction()
    {

        $session = $this->getServiceLocator()->get('Session');
        
        //  $session->offsetUnset('user');
           
        if (!$session->offsetGet('user'))
            return $this->redirect()->toUrl('/social-uno/login/index');                        
               
        
       // $paginator = new Paginator(
       //             new DoctrinePaginator(
       //                     new ORMPaginator($query)
       //             )                
       //         );
       
       // $paginator
       //          ->setCurrentPageNumber($this->params()->fromRoute('page'))
       //         ->setItemCountPerPage(1);
               
//       var_dump($session->fotoPerfil); exit;
        
        return new ViewModel(
                ['fotoPerfil' => $session->fotoPerfil]
        );
    }
}
