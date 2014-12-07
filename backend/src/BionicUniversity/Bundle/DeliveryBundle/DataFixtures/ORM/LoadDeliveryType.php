<?php

namespace BionicUniversity\Bundle\DeliveryBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\DeliveryBundle\Entity\DeliveryStatus;
use BionicUniversity\Bundle\DeliveryBundle\Entity\DeliveryType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDeliveryType extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist((new DeliveryType())->setName('Nova Poshta'));
        $manager->persist((new DeliveryType())->setName('Pickup'));
        $manager->persist((new DeliveryType())->setName('Via Email'));
        $manager->persist((new DeliveryType())->setName('By courier')->setEnabled(false));

        $manager->flush();
    }


    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 21;
    }
}
