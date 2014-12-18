<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 15.12.14
 * Time: 22:23
 */


use League\FactoryMuffin\Facade as FactoryMuffin;

FactoryMuffin::define('BionicUniversity\Bundle\ProductBundle\Entity\Product', array(
    'name'      => 'word',
    'description'      => 'text',
    'price' => 'numberBetween|50;1000',
    'path' => 'imageUrl|640;480'
));