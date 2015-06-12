<?php

namespace SocialUno\Controller;

use SocialUno\Controller\ActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class ConfiguracoesController extends ActionController
{
    public function indexAction()
    {
		$session = $this->getServiceLocator()->get('Session'); 
        if (!$session->offsetGet('user'))
            return $this->redirect()->toUrl('/social-uno/login/index'); 

        $dadosUsuario = $this->getService('SocialUno\Service\Usuario')->findUser($session->offsetGet('user')->getId());
		$fotoUsuario = $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($session->offsetGet('user')->getId());
        return new ViewModel([
             'usuario' => $dadosUsuario,
             'fotoPerfil' => $fotoUsuario
        ]);
    }

    public function saveAction()
    {
    	$this->response->setContent(json_encode(false));

    	if($this->getService('SocialUno\Service\Usuario')->editUser($this->getRequest()->getPost()['data']))
    		$this->response->setContent(json_encode(true));


        return $this->response;
    }
    
}
