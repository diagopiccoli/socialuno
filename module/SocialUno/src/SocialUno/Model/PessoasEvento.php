<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="pessoas_eventos")
 */
class PessoasEventos
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Eventos")
     * @ORM\JoinColumn(name="id_evento", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Eventos    
     */
    protected $evento;

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
    protected $status;

}
