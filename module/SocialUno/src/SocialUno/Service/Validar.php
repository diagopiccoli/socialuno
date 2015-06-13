<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;

class Validar extends Service
{
    public function validarEmail($email) 
    {
        if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) { 
            return true; 
        } 
        
        return false;
    }
    
    public function validaSenha($senha)
    {
        if(strlen($senha) > 3) {
            return true;
        }
        
        return false;
    }
    
    public function validaDataNascimento($data)
    {
    	$data = explode('/', $data);

		
		if(checkdate($data[1], $data[0], $data[2])) {
	       $cond  = date('Y') - $data[2];
		    if($cond >= 16) {
			    return true;
		    }
            if($cond == 15 && (date('m') > $data[1])){
                return true;
            }
            if($cond == 15 && (date('m') == $data[1]) && date('d') > $data[0]){
                return true;
            }
		}
	    
	    return false;
    }
    
}
