<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 10.12.14
 * Time: 22:56
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Cart;


class CartProduct {
    /**
     * @var integer
     */
    private $productId;

    /**
     * @var integer
     */
    private $quantity;

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