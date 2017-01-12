<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipCabinType
 *
 * @ORM\Table(name="ship_cabin_type")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ShipCabinTypeRepository")
 */
class ShipCabinType
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
     * @ORM\Column(name="rt_id", type="integer")
     */
    private $rtId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="place_count_max", type="integer")
     */
    private $placeCountMax;
	 



}

