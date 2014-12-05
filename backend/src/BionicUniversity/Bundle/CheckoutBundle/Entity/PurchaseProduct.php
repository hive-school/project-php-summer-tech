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
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

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
     * @param mixed $product
     */
    public function setProduct( PurchaseProductProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * @var float
     * @ORM\Column(type="integer")
     */
    private $price;




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

