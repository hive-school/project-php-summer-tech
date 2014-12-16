<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 07.12.14
 * Time: 21:00
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Behat;


use Behat\Gherkin\Node\TableNode;
use BionicUniversity\Bundle\CheckoutBundle\Cart\CartProduct;
use Features\DefaultContext;


/**
 * Class CartContext
 * @package BionicUniversity\Bundle\CheckoutBundle\Behat
 */
class CartContext extends DefaultContext{
    /**
     * @Given /^I have in my cart products:$/
     */
    public function iHaveInMyCartProducts(TableNode $table)
    {
        $products = $table->getHash();
        $cart = $this->getContainer()->get('cart');
        foreach($products as $item){
            $product = new CartProduct();
            $product->setProductId($item['id'])
                ->getQuantity($item['quantity']);
            $cart->addProduct($product);
        }
        $cart->save();
    }

    /**
     * @Given /^I'm on cart page;$/
     */
    public function iMOnCartPage()
    {
        $this->getSession()->visit($this->getContainer()->get('router')->generate('cart', array(
            '_locale' => 'en'
        )));
    }
}