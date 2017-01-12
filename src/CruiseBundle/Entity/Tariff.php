<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tariff
 *
 * @ORM\Table(name="tariff")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\TariffRepository")
 */
class Tariff
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



}

