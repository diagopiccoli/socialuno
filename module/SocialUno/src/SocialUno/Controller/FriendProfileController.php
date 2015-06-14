<?php

namespace SocialUno\Controller;

use SocialUno\Controller\ActionController;
use Zend\View\Model\ViewModel;

class FriendProfileController extends ActionController
{
    public function indexAction()
    {
        $session = $this->getServiceLocator()->get('Session'); 
        if (!$session->offsetGet('user'))
            return $this->redirect()->toUrl('/social-uno/login/index');                        

        $dadosUsuario = $this->getService('SocialUno\Service\Usuario')->findUser($_GET['user']);
        $fotoUsuario = $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($dadosUsuario->getId());
        $quantidadeAlbuns = $this->getService('SocialUno\Service\Album')->quantidadeAlbuns($_GET['user'])[0][1];
        $amizade = $this->getService('SocialUno\Service\Usuario')->verificarAmizade($_GET['user']);
        $tipo_usuario = $this->tipoUsuario($amizade, $dadosUsuario->getNome(), $_GET['user']);
        $publicacoes = $this->getService('SocialUno\Service\Publicacao')->buscaPublicacoesUsuario($_GET['user'], $amizade);

    //echo '<pre>';        var_dump($publicacoes); exit;

        return new ViewModel(
             [
             	'fotoUsuario' => $fotoUsuario,
			 	'dadosUsuario' => $dadosUsuario,
                'albuns' => $quantidadeAlbuns,
                'tipo_usuario' => $tipo_usuario,
                'publicacoes' => $publicacoes
			 ]
        );
    }

    private function tipoUsuario($amizade, $nome, $user)
    {
        if($amizade && !empty($amizade)){

            if($amizade['id_status'] == 1)
                return '<h4 class="cursor-pointer" onclick="cancelarSolicitacao()"> '. $nome.' é seu amigo. &nbsp; <span class="fa fa-user-times"></span> </h4> ';
            
            if($amizade['id_status'] == 2){

               if($amizade['id_adicionador'] == $user) 
                    return '<h4 class="cursor-pointer" onclick="adicionaAmigo()">  '. $nome .' lhe enviou uma soliciação de amizade! &nbsp; <span class="fa fa-user-plus"> </span>';
               else
                    return '<h4 class="cursor-pointer" onclick="cancelarSolicitacao()" > Você enviou um soliciação para '. $nome. '<span class="fa fa-user-times"></span>';
            }

        }

        return '<h4 class="cursor-pointer" onclick="adicionarAmigo()"> '.$nome.' não é seu amigo. <span class="fa fa-user-plus"> </span></h4>';
    }
    
    public function adicionarAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $this->response->setContent(json_encode(false));

        if($this->getService('SocialUno\Service\Usuario')->adicionarAmigo($_POST['data'], $session->offsetGet('user')->getId()))
           $this->response->setContent(json_encode(true));

        return $this->response; 
    }

    public function cancelarAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $this->response->setContent(json_encode(false));

        if($this->getService('SocialUno\Service\Usuario')->cancelarSolicitacao($_POST['data'], $session->offsetGet('user')->getId()))
           $this->response->setContent(json_encode(true));

        return $this->response; 
    }

}

