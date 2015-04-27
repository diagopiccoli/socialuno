<?php

namespace SocialUno\Form;

use Zend\Form\Form as Form;

class Login extends Form 
{

    public function __construct() 
    {
        parent::__construct('login');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'id_facebook',
            'type' => 'Hidden',
            'attributes' => array(
                'id' => 'id_facebook'
            ),
        ));
        
        $this->add(array(
            'name' => 'facebook_dados',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'facebook_dados'
            ),
        ));
        
        $this->add(array(
            'name' => 'nome_cadastro',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Nome:',
                'id' => 'nome_cadastro'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'email',
                'placeholder' => 'E-mail:',
            ),
        ));

        $this->add(array(
            'name' => 'novo_usuario_senha',
            'type' => 'password',
            'attributes' => array(
                'id' => 'novo_usuario_senha',
                'placeholder' => 'Senha:',
            ),
        ));
        
        $this->add(array(
            'name' => 'novo_usuario_senha_confirmar',
            'type' => 'password',
            'attributes' => array(
                'id' => 'novo_usuario_senha_confirmar',
                'placeholder' => 'Confirmar Senha:',
            ),
        ));

        $this->add(array(
            'name' => 'genero',
            'type' => 'Select',
            'options' => array(
                'value_options' => array(
                    '0' => 'Genero',
                    'M' => 'Masculino',
                    'F' => 'Feminino',
                ),
            ),
            'attributes' => array(
                'id' => 'genero'
            ),
        ));
        
        $this->add(array(
            'name' => 'data_nascimento',
            'type' => 'text',
            'attributes' => array(
                'id' => 'data_nascimento',
                'placeholder' => 'Data de nascimento',
                'data-type' => 'date',
            ),
        ));
        
        $this->add(array(
            'name' => 'login',
            'type' => 'Text',
            'attributes' => array(
                'id' => 'login',
                'placeholder' => 'Login:',
            ),
        ));
        
        $this->add(array(
            'name' => 'senha',
            'type' => 'password',
            'attributes' => array(
                'id' => 'senha',
                'placeholder' => 'Senha:',
            ),
        ));
        
        $this->add(array(
            'name' => 'cadastrar',
            'type' => 'button',
            'attributes' => array(
                'value' => 'Cadastrar',
                'id' => 'cadastrar',
                'class' => 'btn principal',
                'onclick' => 'cadastrar(this)',
                'data-url' => '/social-uno/login/valida-cadastro'
            ),
        )); 
        
        $this->add(array(
            'name' => 'logar',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Entrar',
                'id' => 'logar',
                'class' => 'btn principal',
                'onclick' => 'logar(this)',
                'data-url' => '/social-uno/login/logar'
            ),
        ));
    }

}
