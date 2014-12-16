<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 09.12.14
 * Time: 23:30
 */

namespace BionicUniversity\Bundle\CheckoutBundle\Cart;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Session\Session;

class Cart extends ArrayCollection implements CartInterface
{
    /** @var  Session */
    private $session;

    /**
     * @param Session $session
     */
    public function setSession(Session $session){
        $this->session = $session;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }


    /**
     * @param CartProduct $product
     */
    public function addProduct(CartProduct $product)
    {
        if(is_numeric($key = $this->findCartProductByProductId($product->getProductId()))){
            /** @var CartProduct $productInCart */
            $productInCart = $this->get($key);
            $productInCart->setQuantity($productInCart->getQuantity() + $product->getQuantity());
        } else {
            $this->add($product);
        }
    }

    public function fetchProducts()
    {
        $products = $this->getSession()->get('cart') ?: array();
        foreach ($products as $product) {
            $this->addProduct($product);
        }
        return $this;
    }

    public function save()
    {
        $this->getSession()->set('cart', $this->toArray());
    }


    private function findCartProductByProductId($id){
        $foundKey = null;
        /** @var CartProduct $item */
        foreach($this->toArray() as $key=>$item){
            if($item->getProductId() == $id){
                $foundKey = $key;
                break;
            }
        }
        return $foundKey;
    }

} 