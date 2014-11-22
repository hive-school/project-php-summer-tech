<?php

namespace BionicUniversity\Bundle\CatalogBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\CatalogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategory extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Gifts');

        $subcategory = new Category();
        $subcategory->setParent($category);
        $subcategory->setName('Souvenirs');


        $manager->persist($subcategory);

        $category = new Category();
        $category->setName('Mars districts');
        $manager->persist($category);

        $manager->flush();
    }


    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }

}