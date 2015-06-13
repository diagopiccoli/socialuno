<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="publicacao")
 */
class Publicacao
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="text") 
     * @var text
     */
    protected $publicacao;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\Usuario    
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="TipoPublicacao")
     * @ORM\JoinColumn(name="id_tipo_publicacao", referencedColumnName="id") 
     *
     * @var \SocialUno\Model\TipoPublicacao    
     */
    protected $tipo_publicacao;

}
