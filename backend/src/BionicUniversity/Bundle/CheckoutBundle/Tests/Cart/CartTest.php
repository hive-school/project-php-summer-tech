<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 09.12.14
 * Time: 23:40
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Tests\Cart;


use BionicUniversity\Bundle\CheckoutBundle\Cart\Cart;
use BionicUniversity\Bundle\CheckoutBundle\Cart\CartProduct;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class CartTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Session */
    private $session;

    /** @var  Cart */
    private $cart;

    public function setUp(){
        $this->session = new Session(new MockArraySessionStorage());
        $this->cart = new Cart();
        $this->cart->setSession($this->session);
    }

    public function testWhenIAddProductToCartThereAreOneProductInCart()
    {
        $cartProduct = new CartProduct();
        $this->cart->addProduct($cartProduct);
        $this->assertEquals(1, $this->cart->count());
    }

    public function testWhenIAddProductThatExistsInCartQuantityIsIncreased(){
        $product = new CartProduct();
        $product->setProductId(1)
            ->setQuantity(1);
        $product2 = new CartProduct();
        $product2->setProductId(1)
            ->setQuantity(2);
        $product3 = new CartProduct();
        $product3->setProductId(2)
            ->setQuantity(2);
        $this->cart->addProduct($product);
        $this->cart->addProduct($product2);
        $this->cart->addProduct($product3);
        $this->assertEquals(2, $this->cart->count());
    }

    public function testAfterSaveTestTheyMustBeInSession(){
        $product = new CartProduct();
        $product->setProductId(1)
            ->setQuantity(1);
        $this->cart->addProduct($product);
        $this->cart->save();
        $this->assertEquals($product, $this->session->get('cart')[0]);
    }

    public function testProductsFromSessionAreInCartAfterFetch(){
        $product = new CartProduct();
        $product->setProductId(1)
            ->setQuantity(1);
        $product2 = new CartProduct();
        $product2->setProductId(2)
            ->setQuantity(2);
        $this->session->set('cart', array($product, $product2));
        $this->cart->fetchProducts();
        $this->assertEquals(array($product, $product2), $this->cart->toArray());
    }
}