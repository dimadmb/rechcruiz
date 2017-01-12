<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProgramItem
 *
 * @ORM\Table(name="program_item")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\ProgramItemRepository")
 */
class ProgramItem
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
	 * @ORM\ManyToOne(targetEntity="Cruise", inversedBy="programs")
	 */
	private $cruise;	
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Place")
	 */
	private $place;
	

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_stop", type="datetime")
     */
    private $dateStop;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="place_title", type="string", length=255)
     */
    private $placeTitle;


}

