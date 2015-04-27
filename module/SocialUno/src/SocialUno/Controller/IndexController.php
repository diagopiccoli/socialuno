<?php

namespace SocialUno\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        
        
       
        
        if (!$session->offsetGet('user')) {

            return $this->redirect()->toUrl('/social-uno/login/index');                       
        }
        
//        $paginator = new Paginator(
//                    new DoctrinePaginator(
//                            new ORMPaginator($query)
//                    )                
//                );
//        
//        $paginator
//                 ->setCurrentPageNumber($this->params()->fromRoute('page'))
//                ->setItemCountPerPage(1);
               
        return new ViewModel(
                ['usuarios' => $paginator]
        );
    }
}
