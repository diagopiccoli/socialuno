<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="usuario")
 */
class Usuario
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true) 
     * @var string
     */
    protected $facebook_id;

    /**
     * @ORM\Column(type="string") 
     * @var string
     */
    protected $senha;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $celular;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('on', 'off')") 
     * @var string
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime")
     * @var date
     */
    protected $data_cadastro;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $sobrenome;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $nome_exibicao;

    /**
     * @ORM\Column(type="datetime")
     * @var date
     */
    protected $data_nascimento;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('M', 'F')") 
     * @var string
     */
    protected $sexo;

    /**
    * @ORM\Column(type="string", nullable=true)
    * @var string
    */
    protected $relacionamento;

    /**
    * @ORM\Column(type="string", nullable=true)
    * @var string
    */
    protected $profissao;

    /**
    * @ORM\Column(type="string", nullable=true)
    * @var string
    */
    protected $formacao;

    /**
    * @ORM\Column(type="string", nullable=true)
    * @var string
    */
    protected $local_trabalho;

    /**
    * @ORM\Column(type="string", nullable=true)
    * @var string
    */
    protected $endereco;

    /**
     * @ORM\Column(type="string") 
     * @var string
     */
    protected $cor_usuario = '#45ada8';

    function getId()
    {
        return $this->id;
    }
    
    function getFacebookId()
    {
        return $this->facebook_id;
    }
    
    function getSenha()
    {
        return $this->senha;
    }

    function getEmail()
    {
        return $this->email;
    }
    
    function getCelular()
    {
	    return $this->celular;
    }

    function getStatus()
    {
        return $this->status;
    }

    function getData_cadastro()
    {
        return $this->data_cadastro;
    }

    function getNome()
    {
        return $this->nome;
    }
    
    function getSobrenome()
    {
	    return $this->sobrenome;
    }

    function getNome_exibicao()
    {
        return $this->nome_exibicao;
    }

    function getData_nascimento()
    {
        return $this->data_nascimento;
    }

    function getSexo()
    {
        return $this->sexo;
    }

    function getCorUsuario()
    {
        return $this->cor_usuario;
    }

    function getRelacionamento()
    {
        return $this->relacionamento;
    }

    function getProfissao()
    {
        return $this->profissao;
    }

    function getFormacao()
    {
        return $this->formacao;
    }

    function getLocalTrabalho()
    {
        return $this->local_trabalho;
    }

    function getEndereco()
    {
        return $this->endereco;
    }
    function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;
    }
    
    function setSenha($senha)
    {
        $this->senha = $senha;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }
    
    function setCelular($celular)
    {
        $this->celular = $celular;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }

    function setData_cadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    function setNome_exibicao($nome_exibicao)
    {
        $this->nome_exibicao = $nome_exibicao;
    }

    function setData_nascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    function setRelacionamento($relacionamento)
    {
        $this->relacionamento = $relacionamento;
    }

    function setProfissao($profissao)
    {
        $this->profissao = $profissao;
    }

    function setFormacao($formacao)
    {
        $this->formacao = $formacao;
    }

    function setLocalTrabalho($local_trabalho)
    {
        $this->local_trabalho = $local_trabalho;
    }

    function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    function setCorUsuario($cor_usuario)
    {
        $this->cor_usuario = $cor_usuario;
    }

}
