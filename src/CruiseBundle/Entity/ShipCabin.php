<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipCabin
 *
 * @ORM\Table(name="ship_cabin")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ShipCabinRepository")
 */
class ShipCabin
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
     * @ORM\ManyToOne(targetEntity="Ship", inversedBy="cabin")
     */
    private $ship;

    /**
     * @var int
     *
     * @ORM\Column(name="deck_id", type="integer")
     */
    private $deckId;


	/**
	 * @ORM\OneToMany(targetEntity="ShipRoom", mappedBy="cabin")
	 */
	private $rooms;

	/**
	 * @ORM\OneToMany(targetEntity="Price", mappedBy="cabin")
	 */
	private $prices;
	

    /**
     * @ORM\ManyToOne(targetEntity="ShipCabinType")
     */
    private $type;	
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="ShipDeck")
	 */
	private $deck;

}

