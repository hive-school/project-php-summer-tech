<?php
/**
 * Created by PhpStorm.
 * User: VladyslavVolkov
 * Date: 12/4/14
 * Time: 8:34 PM
 */

namespace BionicUniversity\Bundle\ProductBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

interface ProductCategoryInterface
{
    /**
     * @return Product[]
     */
    public function getProducts();
}