<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table(name="price")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\PriceRepository")
 */
class Price
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
     * @ORM\ManyToOne(targetEntity="ShipCabinPlace")
     */
    private $place;

    /**
     * @ORM\ManyToOne(targetEntity="ShipCabin", inversedBy="prices")
     */
    private $cabin;

    /**
     * @var int
     *
     * @ORM\Column(name="cruise_id", type="integer")
     */
    private $cruiseId;

    /**
     * @ORM\ManyToOne(targetEntity="Tariff")
     */
    private $tariff;

    /**
     * @ORM\ManyToOne(targetEntity="Meals")
     */
    private $meals;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Cruise", inversedBy="prices")
	 */
	private $cruise; 



}

