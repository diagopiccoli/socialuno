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
    	$data = $data[2].'-'.$data[1].'-'.$data[0];
    
    	$dataPermitida = (((60 * 60) * 24) * 365) * 16;
    	$subtracao = strtotime(date('d/m/Y')) - strtotime($data);
    
	    if($subtracao >= $dataPermitida) {
		    return true;
	    }
	    
	    return false;
    }
    
}
