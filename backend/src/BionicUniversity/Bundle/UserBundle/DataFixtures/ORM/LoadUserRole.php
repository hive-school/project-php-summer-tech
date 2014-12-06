<?php

namespace BionicUniversity\Bundle\UserBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\UserBundle\Entity\Role;
use BionicUniversity\Bundle\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadRole
 * @package BionicUniversity\Bundle\UserBundle\DataFixtures\ORM
 */
class LoadUserRole extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $user */
        $user = $this->getReference('user-admin');
        /** @var Role $role */
        $role = $this->getReference('role-admin');
        $user->addRole($role);

        /** @var User $user */
        $user = $this->getReference('user');
        /** @var Role $role */
        $role = $this->getReference('role-user');
        $user->addRole($role);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
