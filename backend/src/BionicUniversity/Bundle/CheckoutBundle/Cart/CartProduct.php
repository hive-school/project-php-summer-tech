<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 10.12.14
 * Time: 22:56
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Cart;


class CartProduct
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $price;
    /**
     * @var integer
     */
    private $productId;
    /**
     * @var integer
     */
    private $quantity;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param $productId
     * @return $this
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

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
}