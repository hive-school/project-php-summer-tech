<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 09.12.14
 * Time: 23:38
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Cart;


use Doctrine\Common\Collections\ArrayCollection;

interface CartInterface
{
    /**
     * @param CartProduct $product
     * @return void
     */
    public function addProduct(CartProduct $product);

    public function fetchProducts();

    public function save();
} 