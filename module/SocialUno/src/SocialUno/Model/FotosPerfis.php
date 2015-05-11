<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="fotos_perfis")
 */
class FotosPerfis
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id", onDelete="CASCADE") 
     *
     * @var \SocialUno\Model\Usuario
     */
    protected $usuario;

    /**
     * @ORM\Column(type="string") 
     * @var strings
     */
    protected $caminho;

    function getId()
    {
        return $this->id;
    }
    
    function getUsuario()
    {
        return $this->usuario;
    }
    
    function getCaminho()
    {
        return $this->caminho;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    function setCaminho($caminho)
    {
        $this->caminho = $caminho;
    }

}