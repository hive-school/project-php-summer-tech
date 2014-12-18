<?php

namespace BionicUniversity\Bundle\CheckoutBundle\Entity;


use BionicUniversity\Bundle\ProductBundle\Entity\Product;
use BionicUniversity\Bundle\ProductBundle\Entity\ProductPurchaseProductInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * PurchaseProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PurchaseProduct implements ProductPurchaseProductInterface
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
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @var Purchase
     * @ORM\ManyToOne(targetEntity="BionicUniversity\Bundle\CheckoutBundle\Entity\Purchase",inversedBy="products" )
     */
    private $purchase;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="PurchaseProductProductInterface",inversedBy="purchaseProducts")
     */
    private $product;

    /**
     * {@inheritdoc}
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param PurchaseProductProductInterface $product
     * @return $this
     */
    public function setProduct( PurchaseProductProductInterface $product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $price;




    /**
     * @return Purchase
     */
    public function getPurchase()
    {
        return $this->purchase;
    }

    /**
     * @param Purchase $purchase
     */
    public function setPurchase(Purchase $purchase)
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

