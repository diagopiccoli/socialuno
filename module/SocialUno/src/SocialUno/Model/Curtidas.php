<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="curtidas")
 */
class Curtidas
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
     * @ORM\ManyToOne(targetEntity="Publicacao")
     * @ORM\JoinColumn(name="id_publicacao", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Publicacao    
     */
    protected $publicacao;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('curtir', 'descurtir')") 
     * @var string
     */
    protected $tipo;

}
