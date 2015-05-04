<?php

namespace SocialUno\Controller;

use SocialUno\Controller\ActionController;
use Zend\View\Model\ViewModel;
use SocialUno\Form\Login;

class LoginController extends ActionController
{

    public function indexAction()
    {
        $form = new Login();


        $session = $this->getServiceLocator()->get('Session');
        if ($session->offsetGet('user'))
            return $this->redirect()->toUrl('/social-uno/index/index');  

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function validaCadastroAction()
    {
        $return = array('result' => true);

        $values = $this->getRequest()->getPost()['data'];

        if (!$this->getService('SocialUno\Service\Validar')->validaSenha($values['senha'])) {
            $return = [
                'result' => false,
                'type' => 'caracterSenha'
            ];
        }

        if (!$this->getService('SocialUno\Service\Validar')->validarEmail($values['login'])) {
            $return = [
                'result' => false,
                'type' => 'email'
            ];
        }

        if ($return['result']) {
            $cond = $this->getService('SocialUno\Service\Usuario')->createUser($values);
            if (!$cond['valido']) {

                $return = [
                    'result' => false,
                    'type' => 'emailTrue'
                ];
            }
        }

        if($return['result']){

            $values = ['login' => $values['login'], 'senha' => $values['senha']];

            $usuarioLogin = $this->getService('SocialUno\Service\Usuario')->login($values);

            $session = $this->getServiceLocator()->get('Session');
            $session->offsetSet('user', $usuarioLogin);
        }

        $this->response->setContent(json_encode($return));
        return $this->response;
    }

    public function logarAction()
    {
        if ($this->getRequest()->isPost()) {

            $retorno = true;
            $usuarioLogin = $this->getService('SocialUno\Service\Usuario')->login($this->getRequest()->getPost());

            if (!$usuarioLogin) {

                $retorno = false;
                
            } else {

                $session = $this->getServiceLocator()->get('Session');
                $session->offsetSet('user', $usuarioLogin);

            }
            
            $this->response->setContent(json_encode($retorno));
            return $this->response;
        }
    }

}
