<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="album")
 */
class Album
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="TipoAlbum")
     * @ORM\JoinColumn(name="id_tipo_album", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\TipoAlbum    
     */
    protected $tipo_album;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Usuario    
     */
    protected $usuario;

    /**
     * @ORM\Column(type="datetime") 
     * @var datetime
     */
    protected $data_criacao;

    function getId()
    {
        return $this->id;
    }

    function getTipoAlbum()
    {
        return $this->tipo_album;
    }

    function getUsuario()
    {
        return $this->usuario;
    }

    function getDataCriacao()
    {
        return $this->data_criacao;
    }

    function setTipoAlbum($tipo_album)
    {
        $this->tipo_album = $tipo_album;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    function setDataCriacao($data_criacao)
    {
        $this->data_criacao = $data_criacao;
    }

}
