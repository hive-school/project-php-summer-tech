<?php

namespace BionicUniversity\Bundle\DeliveryBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\DeliveryBundle\Entity\DeliveryStatus;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDeliveryStatus extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist((new DeliveryStatus())->setName('Pending'));
        $manager->persist((new DeliveryStatus())->setName('Ready'));
        $manager->persist((new DeliveryStatus())->setName('Delivered'));
        $manager->persist((new DeliveryStatus())->setName('Canceled'));
        $manager->persist((new DeliveryStatus())->setName('Returned'));

        $manager->flush();
    }


    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
