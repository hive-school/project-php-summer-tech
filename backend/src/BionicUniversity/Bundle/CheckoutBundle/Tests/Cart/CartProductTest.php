<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 10.12.14
 * Time: 22:39
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Tests\Cart;


use BionicUniversity\Bundle\CheckoutBundle\Cart\CartProduct;
use BionicUniversity\Bundle\CheckoutBundle\Tests\EntityTestCase;

class CartProductTest extends EntityTestCase
{
    protected function createTestedObject()
    {
        return new CartProduct();
    }

    /**
     * @return array
     */
    protected function getFixtureClassData()
    {
        return array(
            'id' => 1,
            'productId' => 2,
            'quantity' => 3,
        );
    }
} 