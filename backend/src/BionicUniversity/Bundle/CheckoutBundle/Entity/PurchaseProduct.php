<?php

namespace BionicUniversity\Bundle\CheckoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PurchaseProduct
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var PurchaseProduct
     * @ORM\ManyToOne(targetEntity="BionicUniversity\Bundle\CheckoutBundle\Entity\Purchase",inversedBy="products" )
     */
    private $purchase;
    /**
     * @var ProductInterface
     */
    private $product;
    /**
     * @var float
     */
    private $price;

    //    private Product from product-bundle $product;


    /**
     * @return PurchaseProduct
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * @param PurchaseProduct $purchase
     */
    public function setPurchase(PurchaseProduct $purchase)
    {
        $this->purchase = $purchase;
    }



    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

