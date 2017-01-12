<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShipCabinPlace
 *
 * @ORM\Table(name="ship_cabin_place")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ShipCabinPlaceRepository")
 */
class ShipCabinPlace
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
     * @ORM\Column(name="rp_id", type="integer")
     */
    private $rpId;

    /**
     * @var string
     *
     * @ORM\Column(name="rp_name", type="string", length=255)
     */
    private $rpName;




}

