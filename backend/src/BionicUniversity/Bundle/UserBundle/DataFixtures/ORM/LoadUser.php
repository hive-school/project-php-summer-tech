<?php

namespace BionicUniversity\Bundle\UserBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadRole
 * @package BionicUniversity\Bundle\UserBundle\DataFixtures\ORM
 */
class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('adminpass');
        $user->setEmail('admin@local.host');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->setReference('user-admin', $user);

        $user = new User();
        $user->setUsername('user');
        $user->setPassword('userpass');
        $user->setEmail('user@local.host');
        $user->setIsActive(true);
        $manager->persist($user);
        $this->setReference('user', $user);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
