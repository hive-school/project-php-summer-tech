<?php

namespace BionicUniversity\Bundle\UserBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\UserBundle\Entity\Role;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadRole
 * @package BionicUniversity\Bundle\UserBundle\DataFixtures\ORM
 */
class LoadRole extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $role = new Role();
        $role->setName('Administrator');
        $role->setRole('ROLE_ADMIN');
        $manager->persist($role);
        $this->setReference('role-admin', $role);

        $role = new Role();
        $role->setName('User');
        $role->setRole('ROLE_USER');
        $manager->persist($role);
        $this->setReference('role-user', $role);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
