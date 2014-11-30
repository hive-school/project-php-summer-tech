<?php

namespace BionicUniversity\Bundle\CheckoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrderProduct
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
     * @var integer
     * @ORM\Column(name="quantity")
     */
    private $quantity;

    /**
     * @var OrderProduct
     * @ORM\ManyToOne(targetEntity="BionicUniversity\Bundle\CheckoutBundle\Entity\Purchase",inversedBy="products" )
     */
    private $purchase;

    //    private Product from product-bundle $product;


    /**
     * @return OrderProduct
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * @param OrderProduct $purchase
     */
    public function setPurchase($purchase)
    {
        $this->purchase = $purchase;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

