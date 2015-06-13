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

}
