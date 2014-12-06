<?php

namespace BionicUniversity\Bundle\ProductBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\CatalogBundle\Entity\Category;
use BionicUniversity\Bundle\ProductBundle\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProduct extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('Shuttle');
        $category = $manager->getRepository('BionicUniversityCatalogBundle:Category')->findOneBy([]);
        $product->setCategory($category);
        $product->setDescription('Some text description');

        $status = $manager->getRepository('BionicUniversityProductBundle:Product\Status')->findOneBy([]);
        $product->setStatus($status);

        $product->setPrice(9.99);
        $manager->persist($product);
        $manager->flush();
    }


    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 3;
    }

}