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
           //   $session->offsetUnset('user');
        if (!$session->offsetGet('user'))
            return $this->redirect()->toUrl('/social-uno/login/index'); 

        $solicitacoes = $this->getService('SocialUno\Service\Usuario')->buscaSolicitacoes($session->offsetGet('user')->getId()); 
        $amigos = $this->getService('SocialUno\Service\Usuario')->buscaAmigos($session->offsetGet('user')->getId()); 
 
        $arrAux = []; $ids_amigos = '';
        foreach($amigos as $list){
            if($list['usuario']['id'] != $session->offsetGet('user')->getId()){
                $arrAux[] = ['user' => $list['usuario'], 'foto' => $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($list['usuario']['id'])];
                $ids_amigos .= $list['usuario']['id'].', ';
            }
            if($list['amizade']['id'] != $session->offsetGet('user')->getId()){
                $arrAux[] =  ['user' => $list['amizade'], 'foto' => $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($list['amizade']['id'])];
                $ids_amigos .= $list['amizade']['id'].', ';
            }
        }     

        $ids_amigos .=  $session->offsetGet('user')->getId();
        $publicacoes = $this->getService('SocialUno\Service\Publicacao')->buscaPublicacoesAmigos($ids_amigos);

       //var_dump($publicacoes); exit;
        $arrAuxPub = [];
        foreach ($publicacoes as $key => $value) {
                $arrAuxPub[] = [
                    'pub' => $value, 
                    'foto' => $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($value['usuario']['id']),
                    'curtir' => $this->getService('SocialUno\Service\Publicacao')->buscaCurtidas($value['id'], $session->offsetGet('user')->getId(), 'curtir'),
                    'nao_curti' => $this->getService('SocialUno\Service\Publicacao')->buscaCurtidas($value['id'], $session->offsetGet('user')->getId(), 'descurtir')
                ];
        }    

        return new ViewModel([
                'fotoPerfil' => $session->fotoPerfil,
                'solicitacoes' => count($solicitacoes),
                'amigos' => $arrAux,
                'publicacoes' => $arrAuxPub
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

    public function curtirPublicacaoAction()
    {

        $session = $this->getServiceLocator()->get('Session');
        $result = $this->getService('SocialUno\Service\Publicacao')->curtirPublicacao($_POST['data'], $session->offsetGet('user')->getId(), 'curtir');
        $this->response->setContent(json_encode(false));
        if($result){
             $this->response->setContent(json_encode(true));
        }

        return $this->response;
    }

    public function descurtirPublicacaoAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $result = $this->getService('SocialUno\Service\Publicacao')->descurtirPublicacao($_POST['data'], $session->offsetGet('user')->getId());
        $this->response->setContent(json_encode(false));
        if($result){
             $this->response->setContent(json_encode(true));
        }


        return $this->response;
    }

    public function naoCurtiPublicacaoAction()
    {

        $session = $this->getServiceLocator()->get('Session');
        $result = $this->getService('SocialUno\Service\Publicacao')->curtirPublicacao($_POST['data'], $session->offsetGet('user')->getId(), 'descurtir');
        $this->response->setContent(json_encode(false));
        if($result){
             $this->response->setContent(json_encode(true));
        }

        return $this->response;
    }

    
}
