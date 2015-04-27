<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;

class Validar extends Service
{
    public function validarEmail($email) 
    {
        
        if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)){ 
            return true; 
        } 
        
        return false;
    }
    
    public function validaSenha($senha)
    {
        if(strlen($senha) > 3){
            return true;
        }
        
        return false;
    }
}
