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

}
