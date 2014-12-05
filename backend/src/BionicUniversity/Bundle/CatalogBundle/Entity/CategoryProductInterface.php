<?php
/**
 * Created by PhpStorm.
 * User: VladyslavVolkov
 * Date: 12/4/14
 * Time: 8:30 PM
 */

namespace BionicUniversity\Bundle\CatalogBundle\Entity;


interface CategoryProductInterface
{

    /**
     * @return Category
     */
    public function getCategory();

}