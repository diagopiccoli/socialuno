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
     * @ORM\Column(type="datetime") 
     * @var datetime
     */
    protected $data_publicacao;

}
