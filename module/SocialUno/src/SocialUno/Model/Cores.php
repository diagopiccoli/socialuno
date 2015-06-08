<?php

namespace SocialUno\Model;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity 
 *   @ORM\Table(name="cores")
 */
class Cores
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string") 
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column(type="string") 
     * @var string
     */
    protected $html_cor;

}
