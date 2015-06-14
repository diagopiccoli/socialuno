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
           //$session->offsetUnset('user');
        if (!$session->offsetGet('user'))
            return $this->redirect()->toUrl('/social-uno/login/index'); 

        $solicitacoes = $this->getService('SocialUno\Service\Usuario')->buscaSolicitacoes($session->offsetGet('user')->getId()); 

        $amigos = $this->getService('SocialUno\Service\Usuario')->buscaAmigos($session->offsetGet('user')->getId()); 
 
        $arrAux = [];
        foreach($amigos as $list){
            if($list['usuario']['id'] != $session->offsetGet('user')->getId()){
                $arrAux[] = ['user' => $list['usuario'], 'foto' => $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($list['usuario']['id'])];
            }
            if($list['amizade']['id'] != $session->offsetGet('user')->getId()){
                $arrAux[] =  ['user' => $list['amizade'], 'foto' => $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($list['amizade']['id'])];
            }
        }           
    
        return new ViewModel([
                'fotoPerfil' => $session->fotoPerfil,
                'solicitacoes' => count($solicitacoes),
                'amigos' => $arrAux
        ]);
    }
    
    public function logoutAction()
    {
        $session = $this->getServiceLocator()->get('Session');

        $this->getService('SocialUno\Service\Usuario')->changeStatus($session->offsetGet('user')->getId(), 'off');
        
        $session->offsetUnset('user');
        $session->fotoPerfil='';
        
        $result = array('login' => 'ok');   
        $this->response->setContent(json_encode($result));
        return $this->response;
    }
    
    public function ajaxBuscaUsuariosAction()
    {
         $result = $this->getService('SocialUno\Service\Usuario')->findUsuariosByName($this->getRequest()->getPost()['data']);
         $view = new ViewModel(
                ['usuarios' => $result]
        );
         
        $view->setTerminal(true); 
        
        return $view;
    }

    public function savePublicacaoAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $result = $this->getService('SocialUno\Service\Publicacao')->adicionarPublicacao($_POST, $_FILES['fotosLinhaTempo'], $session->offsetGet('user')->getId());
        $this->response->setContent(json_encode(false));
        if($result){
             $this->response->setContent(json_encode(true));
        }


        return $this->response;
    }
    
}
