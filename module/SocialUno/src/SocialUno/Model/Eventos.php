<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="eventos")
 */
class Eventos
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Usuario    
     */
    protected $usuario;

    /**
     * @ORM\Column(type="string") 
     * @var string
     */
    protected $desc_evento;

    /**
     * @ORM\Column(type="datetime") 
     * @var datetime
     */
    protected $data_criacao;

     /**
     * @ORM\Column(type="string", nullable=true) 
     * @var string
     */
    protected $foto;

}
