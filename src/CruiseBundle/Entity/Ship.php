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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="class", type="integer", nullable=true)
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
     * @ORM\Column(name="imgUrl", type="string", length=255, nullable=true)
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




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cruises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cabin = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set class
     *
     * @param integer $class
     *
     * @return Ship
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return integer
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Ship
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Ship
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set shipId
     *
     * @param integer $shipId
     *
     * @return Ship
     */
    public function setShipId($shipId)
    {
        $this->shipId = $shipId;

        return $this;
    }

    /**
     * Get shipId
     *
     * @return integer
     */
    public function getShipId()
    {
        return $this->shipId;
    }

    /**
     * Set imgUrl
     *
     * @param string $imgUrl
     *
     * @return Ship
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * Set turOperator
     *
     * @param \CruiseBundle\Entity\TurOperator $turOperator
     *
     * @return Ship
     */
    public function setTurOperator(\CruiseBundle\Entity\TurOperator $turOperator = null)
    {
        $this->turOperator = $turOperator;

        return $this;
    }

    /**
     * Get turOperator
     *
     * @return \CruiseBundle\Entity\TurOperator
     */
    public function getTurOperator()
    {
        return $this->turOperator;
    }

    /**
     * Add cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     *
     * @return Ship
     */
    public function addCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruises[] = $cruise;

        return $this;
    }

    /**
     * Remove cruise
     *
     * @param \CruiseBundle\Entity\Cruise $cruise
     */
    public function removeCruise(\CruiseBundle\Entity\Cruise $cruise)
    {
        $this->cruises->removeElement($cruise);
    }

    /**
     * Get cruises
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCruises()
    {
        return $this->cruises;
    }

    /**
     * Add cabin
     *
     * @param \CruiseBundle\Entity\ShipCabin $cabin
     *
     * @return Ship
     */
    public function addCabin(\CruiseBundle\Entity\ShipCabin $cabin)
    {
        $this->cabin[] = $cabin;

        return $this;
    }

    /**
     * Remove cabin
     *
     * @param \CruiseBundle\Entity\ShipCabin $cabin
     */
    public function removeCabin(\CruiseBundle\Entity\ShipCabin $cabin)
    {
        $this->cabin->removeElement($cabin);
    }

    /**
     * Get cabin
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCabin()
    {
        return $this->cabin;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Ship
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
