<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 14.12.14
 * Time: 13:22
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Controller;


use BionicUniversity\Bundle\CheckoutBundle\Cart\CartProduct;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Cart controller
 *
 * @Route("/cart")
 */
class CartController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * @Route("/", name="cart")
     * @Method("GET")
     */
    public function doomAction(){
//        $cart = $this->get('cart');
//        $product = new CartProduct();
//        $product->setProductId(1)->setQuantity(55);
//        $cart->addProduct($product);
        $products = $this->get('cart')
            ->fetchProducts()
            ->toArray();
        return $this->render('BionicUniversityCheckoutBundle:Cart:cart.html.twig', array(
            'products' => $products
        ));
    }
}