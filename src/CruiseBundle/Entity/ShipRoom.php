<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipRoom
 *
 * @ORM\Table(name="ship_room")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ShipRoomRepository")
 */
class ShipRoom
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
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="ShipCabin", inversedBy="rooms")
     */
    private $cabin;



}

