<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;
use SocialUno\Model\Usuario as UsuarioModel;
use SocialUno\Model\FotosPerfis as FotosPerfis;

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
    
    public function findFotoPerfil($id_usuario)
    {
        $result = $this->getObjectManager()
                    ->getRepository('\SocialUno\Model\FotosPerfis')
                        ->findOneBy(
                           array(
                               'usuario' => $id_usuario
                           )
                        );
        
       return $result->getCaminho();
    }

    public function createUser(array $values)
    {
        foreach($values as $list){
            if($list == ''){
                return false;
            }
        }
        
        if($this->getObjectManager()->getRepository('SocialUno\Model\Usuario')->findBy(array('email' => $values['login']))){
            return ['valido' => false, 'tipo' => 'emailTrue'];
        }
        
        if($this->getObjectManager()->getRepository('SocialUno\Model\Usuario')->findBy(array('facebook_id' => $values['id_facebook']))){
             return ['valido' => false, 'tipo' => 'facebook'];
        }
        
        $newUsuario = $this->setUsuario($values); 
        
        $this->getObjectManager()->persist($newUsuario);
     
        $this->getObjectManager()->persist($this->setFotoPerfil($values['foto_facebook'], $newUsuario));
        
        try {
            $this->getObjectManager()->flush();
            return ['valido' => true];
        } catch (Exception $exc) {
            return ['valido' => false];
        }

    }

    private function setFotoPerfil($foto, $newUsuario)
    {
        if($foto == ''){
            $foto = '/images/sem_foto.jpg';
        }
        
        $fotoPerfil = new FotosPerfis();
        $fotoPerfil->setUsuario($newUsuario);
        $fotoPerfil->setCaminho($foto);

        return $fotoPerfil;
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
        $usuario->setStatus("on");
        $dataNascimento = new \DateTime($this->dateToBanco($values['data_nascimento']));
        $usuario->setData_nascimento($dataNascimento);
        $usuario->setSexo($values['genero']);
        
        return $usuario;
        
    }
    
    public function findUsuariosByName($values)
    {
        $select = $this->getObjectManager()->createQueryBuilder()
                ->select('foto.caminho', 'usu.id' ,'usu.nome_exibicao')
                ->from('SocialUno\Model\FotosPerfis', 'foto')
                ->join('foto.usuario', 'usu')
                ->orderBy('usu.nome_exibicao', 'ASC')
                ->where("usu.nome_exibicao LIKE ?1")
                ->setParameter(1, $values['busca'] . "%");

        return $select->getQuery()->getResult();
      
    }
    
}
