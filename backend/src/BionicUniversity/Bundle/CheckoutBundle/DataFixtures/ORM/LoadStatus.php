<?php
/**
 * Created by PhpStorm.
 * User: sania
 * Date: 18.12.14
 * Time: 2:53
 */

namespace BionicUniversity\Bundle\CheckoutBundle\DataFixtures\ORM;


use BionicUniversity\Bundle\CheckoutBundle\Entity\Status;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;

class LoadStatus  extends AbstractFixture{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName('new');
        $manager->persist($status);
        $manager->flush();
    }

} 