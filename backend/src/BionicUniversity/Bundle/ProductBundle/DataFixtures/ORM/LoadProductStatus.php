<?php

namespace BionicUniversity\Bundle\ProductBundle\DataFixtures\ORM;


use BionicUniversity\Bundle\ProductBundle\Entity\Product\Status;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductStatus extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @inheritdoc
     */
    function load(ObjectManager $manager)
    {
        $productStatus = new Status();
        $productStatus->setName('In sale');

        $manager->persist($productStatus);

        $productStatus = new Status();
        $productStatus->setName('Wait');

        $manager->persist($productStatus);
        $manager->flush();
    }

    /**
     * @inheritdoc
     */
    function getOrder()
    {
        return 2;
    }
}