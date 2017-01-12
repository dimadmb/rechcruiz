<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ship
 *
 * @ORM\Table(name="ship")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ShipRepository")
 */
class Ship
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
     * @var int
     *
     * @ORM\Column(name="class", type="integer")
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="shipId", type="integer")
     */
    private $shipId;

    /**
     * @ORM\ManyToOne(targetEntity="TurOperator", inversedBy="ships")
     */
    private $turOperator;

    /**
     * @var string
     *
     * @ORM\Column(name="imgUrl", type="string", length=255)
     */
    private $imgUrl;
	
	/**
	 * @ORM\OneToMany(targetEntity="Cruise", mappedBy="ship")
	 */
	private $cruises;
	
	/**
	 * @ORM\OneToMany(targetEntity="ShipCabin", mappedBy="ship")
	 */
	private $cabin;
	
	


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




}

