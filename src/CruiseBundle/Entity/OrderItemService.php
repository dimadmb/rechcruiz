<?php

namespace CruiseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItemService
 *
 * @ORM\Table(name="order_item_service")
 * @ORM\Entity(repositoryClass="CruiseBundle\Repository\OrderItemServiceRepository")
 */
class OrderItemService
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price_value", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $priceValue;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_fee", type="boolean")
     */
    private $isFee = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_permanent_discount", type="boolean")
     */
    private $isPermanentDiscount = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_seson_discount", type="boolean")
     */
    private $isSesonDiscount = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active = true;
	
	
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Ordering", inversedBy="service")
	 */
	private $order;


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
     * Set name
     *
     * @param string $name
     *
     * @return OrderItemService
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
     * Set priceValue
     *
     * @param string $priceValue
     *
     * @return OrderItemService
     */
    public function setPriceValue($priceValue)
    {
        $this->priceValue = $priceValue;

        return $this;
    }

    /**
     * Get priceValue
     *
     * @return string
     */
    public function getPriceValue()
    {
        return $this->priceValue;
    }

    /**
     * Set isFee
     *
     * @param boolean $isFee
     *
     * @return OrderItemService
     */
    public function setIsFee($isFee)
    {
        $this->isFee = $isFee;

        return $this;
    }

    /**
     * Get isFee
     *
     * @return bool
     */
    public function getIsFee()
    {
        return $this->isFee;
    }

    /**
     * Set isPermanentDiscount
     *
     * @param boolean $isPermanentDiscount
     *
     * @return OrderItemService
     */
    public function setIsPermanentDiscount($isPermanentDiscount)
    {
        $this->isPermanentDiscount = $isPermanentDiscount;

        return $this;
    }

    /**
     * Get isPermanentDiscount
     *
     * @return bool
     */
    public function getIsPermanentDiscount()
    {
        return $this->isPermanentDiscount;
    }

    /**
     * Set isSesonDiscount
     *
     * @param boolean $isSesonDiscount
     *
     * @return OrderItemService
     */
    public function setIsSesonDiscount($isSesonDiscount)
    {
        $this->isSesonDiscount = $isSesonDiscount;

        return $this;
    }

    /**
     * Get isSesonDiscount
     *
     * @return bool
     */
    public function getIsSesonDiscount()
    {
        return $this->isSesonDiscount;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return OrderItemService
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set order
     *
     * @param \CruiseBundle\Entity\Ordering $order
     *
     * @return OrderItemService
     */
    public function setOrder(\CruiseBundle\Entity\Ordering $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \CruiseBundle\Entity\Ordering
     */
    public function getOrder()
    {
        return $this->order;
    }
}
