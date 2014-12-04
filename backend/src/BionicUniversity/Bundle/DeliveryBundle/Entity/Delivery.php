<?php

namespace BionicUniversity\Bundle\DeliveryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delivery
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Delivery
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var DeliveryStatus
     *
     * @ORM\ManyToOne(targetEntity="BionicUniversity\Bundle\DeliveryBundle\Entity\DeliveryStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * @var DeliveryType
     *
     * @ORM\ManyToOne(targetEntity="BionicUniversity\Bundle\DeliveryBundle\Entity\DeliveryType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliveredAt", type="datetime")
     */
    private $deliveredAt;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Delivery
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set status
     *
     * @param DeliveryStatus $status
     *
     * @return Delivery
     */
    public function setStatus(DeliveryStatus $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return DeliveryStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param DeliveryType $type
     *
     * @return Delivery
     */
    public function setType(DeliveryType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return DeliveryType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set deliveredAt
     *
     * @param \DateTime $deliveredAt
     *
     * @return Delivery
     */
    public function setDeliveredAt($deliveredAt)
    {
        $this->deliveredAt = $deliveredAt;

        return $this;
    }

    /**
     * Get deliveredAt
     *
     * @return \DateTime
     */
    public function getDeliveredAt()
    {
        return $this->deliveredAt;
    }
}

