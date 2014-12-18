<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 14.12.14
 * Time: 13:22
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Controller;


use BionicUniversity\Bundle\CheckoutBundle\Cart\CartProduct;
use BionicUniversity\Bundle\CheckoutBundle\Entity\Purchase;
use BionicUniversity\Bundle\CheckoutBundle\Entity\PurchaseProduct;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Cart controller
 *
 * @Route("/cart")
 */
class CartController extends Controller
{
    /**
     * @Route("/", name="cart")
     * @Method("GET")
     */
    public function showCartAction(){
        $cart = $this->get('cart');
        $products = $cart->fetchProducts()
            ->toArray();
        return $this->render('BionicUniversityCheckoutBundle:Cart:cart.html.twig', array(
            'products' => $products,
            'totalPrice' => $cart->getTotalPrice()
        ));
    }

    /**
     * @Route("/add/{productId}", name="add_to_cart")
     * @param $productId
     * @return Response
     */
    public function addToCart($productId)
    {
        $cart = $this->get('cart');
        $om = $this->getDoctrine()->getRepository('BionicUniversityProductBundle:Product');
        $product = $om->find($productId);

        $cartProduct = new CartProduct();
        $cartProduct->setQuantity(1)
            ->setProductId($productId)
            ->setName($product->getName())
            ->setPrice($product->getPrice());

        $cart->fetchProducts();
        $cart->addProduct($cartProduct);
        $cart->save();
        return new Response(json_encode(array('productsInCart' => $cart->count())));
    }

    /**
     * @Route("/remove/{productId}", name="remove_from_cart")
     * @param $productId
     * @return Response
     */
    public function removeFromCart($productId){
        $cart = $this->get('cart');
        $cart->fetchProducts();
        $cart->removeProduct($productId);
        $cart->save();
        return new Response(json_encode(array('productsInCart' => $cart->count())));
    }

    /**
     * @Route("/purchase", name="perform_purchase")
     */
    public function performPurchase(){
        // todo refactor (this is demo version)
        $om = $this->getDoctrine()->getManager();
        $cart = $this->get('cart');
        $cart->fetchProducts();
        $purchase = new Purchase();
        $status = $this->getDoctrine()
            ->getRepository('BionicUniversityCheckoutBundle:Status')
            ->findOneBy(array('name'=>'new'));
        $purchase->setStatus($status)
            ->setEmail('test@gmail.com')
            ->setFirstName('test')
            ->setLastName('testLastName')
            ->setSum($cart->getTotalPrice())
            ->setTelephoneNumber('0993533232');
        $om->persist($purchase);
        $productRepository = $this->getDoctrine()->getRepository('BionicUniversityProductBundle:Product');
        /** @var CartProduct $cartProduct */
        foreach($cart->toArray() as $cartProduct){
            $purchaseProduct = new PurchaseProduct();
            $product = $productRepository->find($cartProduct->getProductId());
            $purchaseProduct->setProduct($product)
                ->setPrice($cartProduct->getPrice())
                ->setQuantity($cartProduct->getQuantity())
                ->setPurchase($purchase);
            $om->persist($purchaseProduct);
        }
        $om->flush();
        $cart->clear();
        $cart->save();
        return $this->redirect('/');
    }
}