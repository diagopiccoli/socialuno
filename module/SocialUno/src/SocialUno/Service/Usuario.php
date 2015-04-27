<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;
use SocialUno\Model\Usuario as UsuarioModel;

class Usuario extends Service
{
    
    public function login($values)
    {
        $result = $this->getObjectManager()
                        ->getRepository('\SocialUno\Model\Usuario')
                        ->findOneBy(
                            array(
                                'email' => $values['login'],
                                'senha' => md5($values['senha'])
                            )
                        );
                        
        return $result;
        
    }

    public function createUser(array $values)
    {
        foreach($values as $list){
            if($list == ''){
                return false;
            }
        }
        
        if($this->getObjectManager()->getRepository('SocialUno\Model\Usuario')->findBy(array('email' => $values['login']))){
            return ['valido' => false, 'tipo' => 'email'];
        }
        
        $this->getObjectManager()->persist($this->setUsuario($values)); 
        
        try {
            $this->getObjectManager()->flush();
            return ['valido' => true];
        } catch (Exception $exc) {
            return ['valido' => false];
        }
    }
    
    private function setUsuario(array $values)
    {
           
        $usuario = new UsuarioModel();

        if($values['id_facebook'] != ''){
            $usuario->setFacebookId($values['id_facebook']);
        }
        $usuario->setNome($values['nome']);
        $usuario->setEmail($values['login']);
        $usuario->setNome_exibicao($values['nome']);
        $usuario->setData_cadastro(new \DateTime('now'));
        $usuario->setSenha(md5($values['senha']));
        $dataNascimento = new \DateTime($this->dateToBanco($values['data_nascimento']));
        $usuario->setData_nascimento($dataNascimento);
        $usuario->setSexo($values['genero']);
        
        return $usuario;
        
    }
    
}
