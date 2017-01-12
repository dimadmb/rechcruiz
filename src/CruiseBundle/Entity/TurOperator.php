<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TurOperator
 *
 * @ORM\Table(name="tur_operator")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\TurOperatorRepository")
 */
class TurOperator
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="inSale", type="boolean")
     */
    private $inSale;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="Ship", mappedBy="turOperator")
	 */
	private $ships;



}

