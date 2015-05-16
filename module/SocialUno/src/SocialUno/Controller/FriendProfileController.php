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
        
        echo'<pre>';  var_dump($dadosUsuario, $fotoUsuario); exit;
        
        return new ViewModel(
             
        );
    }
    
}

