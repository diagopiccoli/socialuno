<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="fotos")
 */
class Fotos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumn(name="id_album", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Album    
     */
    protected $album;

    /**
     * @ORM\Column(type="string") 
     * @var string
     */
    protected $caminho;
    
    /**
    * @ORM\Column(type="string", nullable=true) 
    * @var string
    */
    protected $desc_foto;

    /**
     * @ORM\Column(type="datetime") 
     * @var datetime
     */
    protected $data_publicacao;

    function getId()
    {
        return $this->id;
    }

    function getAlbum()
    {
        return $this->album;
    }

    function getCaminho()
    {
        return $this->caminho;
    }

    function getDescFoto()
    {
        return $this->desc_foto;
    }

    function getDataPublicacao()
    {
        return $this->data_publicacao;
    }    

    function setAlbum($album)
    {
        $this->album = $album;
    }

    function setCaminho($caminho)
    {
        $this->caminho = $caminho;
    }

    function setDescFoto($desc_foto)
    {
        $this->desc_foto = $desc_foto;
    }

    function setDataPublicacao($data_publicacao)
    {
        $this->data_publicacao = $data_publicacao;
    }

}
