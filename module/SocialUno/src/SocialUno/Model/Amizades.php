<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="amizades")
 */
class Amizades
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
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_amigo", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Usuario    
     */
    protected $amizade;

    /**
     * @ORM\ManyToOne(targetEntity="StatusAmizade")
     * @ORM\JoinColumn(name="id_status_amizade", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\StatusAmizade    
     */
    protected $status_amizade;

    function getId()
    {
        return $this->id;
    }

    function getUsuario()
    {
        return $this->usuario;
    }

    function getAmizade()
    {
        return $this->amizade;
    }

    function getStatusAmizade()
    {
        return $this->status_amizade;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    function setAmizade($amizade)
    {
        $this->amizade = $amizade;
    }

    function setStatusAmizade($status_amizade)
    {
        $this->status_amizade = $status_amizade;
    }
}
