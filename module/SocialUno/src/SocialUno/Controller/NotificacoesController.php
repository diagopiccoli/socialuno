<?php

namespace SocialUno\Controller;

use SocialUno\Controller\ActionController;
use Zend\View\Model\ViewModel;

class NotificacoesController extends ActionController
{
    public function indexAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        if (!$session->offsetGet('user'))
            return $this->redirect()->toUrl('/social-uno/login/index'); 

        $solicitacoes = $this->getService('SocialUno\Service\Usuario')->buscaSolicitacoes($session->offsetGet('user')->getId());

        $arrayAux = [];
        foreach ($solicitacoes as $key => $value) {
        	$arrayAux[] = [
        		'id' => $value['id_adicionador'],
        		'nome' =>$value['nome'], 
        		'foto' => $this->getService('SocialUno\Service\Usuario')->findFotoPerfil($value['id_adicionador'])
        	];
        }                 
    
        return new ViewModel([
                'fotoPerfil' => $session->fotoPerfil,
                'solicitacoes' => $arrayAux
        ]);
    }

    public function cancelarAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $this->response->setContent(json_encode(false));

        if($this->getService('SocialUno\Service\Usuario')->cancelarSolicitacao($session->offsetGet('user')->getId(), $_POST['data']))
           $this->response->setContent(json_encode(true));

        return $this->response; 
    }

    public function aceitarAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $this->response->setContent(json_encode(false));

        if($this->getService('SocialUno\Service\Usuario')->aceitarSolicitacao($session->offsetGet('user')->getId(), $_POST['data']))
           $this->response->setContent(json_encode(true));

       

        return $this->response; 
    }
    
}
