<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruise
 *
 * @ORM\Table(name="cruise")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\CruiseRepository")
 */
class Cruise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Category" )
	 */
	private $category;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer", unique=true)
     */
    private $code;

    /**
	 * @ORM\ManyToOne(targetEntity="Ship", inversedBy="cruises")
     */
    private $ship;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \Date
     *
     * @ORM\Column(name="startDate", type="date")
     */
    private $startDate;

    /**
     * @var \Date
     *
     * @ORM\Column(name="endDate", type="date")
     */
    private $endDate;

    /**
     * @var int
     *
     * @ORM\Column(name="dayCount", type="integer")
     */
    private $dayCount;
	
	
	/**
	 * @ORM\OneToMany(targetEntity="Price", mappedBy="cruise")
	 */
	private $prices;

	
	/**
	 * @ORM\OneToMany(targetEntity="ProgramItem", mappedBy="cruise")
	 */
	private $programs;
	
	/**
     * @ORM\ManyToOne(targetEntity="TurOperator")
     */
    private $turOperator;


}

