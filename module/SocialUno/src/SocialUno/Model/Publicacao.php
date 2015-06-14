<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="publicacao")
 */
class Publicacao
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", nullable=true) 
     * @var text
     */
    protected $publicacao;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Usuario    
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="TipoPublicacao")
     * @ORM\JoinColumn(name="id_tipo_publicacao", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\TipoPublicacao    
     */
    protected $tipo_publicacao;

    /**
     * @ORM\Column(type="datetime",) 
     * @var datetime
     */
    protected $data_publicacao;

    function getId()
    {
        return $this->id;
    }

    function getPublicacao()
    {
        return $this->publicacao;
    }

    function getUsuario()
    {
        return $this->usuario;
    }

    function getTipoPublicacao()
    {
        return $this->tipo_publicacao;
    }

    function getDataPublicacao()
    {
        return $this->data_publicacao;
    }

    function setPublicacao($publicacao)
    {
        $this->publicacao = $publicacao;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    function setTipoPublicacao  ($tipo_publicacao)
    {
        $this->tipo_publicacao = $tipo_publicacao;
    }

    function setDataPublicacao($data_publicacao)
    {
        $this->data_publicacao = $data_publicacao;
    }



}
