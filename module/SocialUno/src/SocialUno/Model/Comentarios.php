<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="comentarios")
 */
class Comentarios
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
     * @ORM\Column(type="text") 
     * @var text
     */
    protected $comentario;

}
