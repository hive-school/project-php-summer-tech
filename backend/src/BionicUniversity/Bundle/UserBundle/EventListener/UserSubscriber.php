<?php

namespace BionicUniversity\Bundle\UserBundle\EventListener;

use BionicUniversity\Bundle\UserBundle\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * Class UserSubscriber
 * @package BionicUniversity\Bundle\UserBundle\EventListener
 */
class UserSubscriber implements EventSubscriber
{
    /**
     * @var \Symfony\Component\Security\Core\Encoder\EncoderFactory
     */
    private $encoderFactory;

    public function __construct(EncoderFactory $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {
            $this->encodePassword($entity);
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {
            if ($args->hasChangedField('password')) {
                $this->encodePassword($entity);
            }
        }
    }

    private function encodePassword(User $entity)
    {
        $encoder = $this->encoderFactory->getEncoder($entity);
        $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);

        return $entity;
    }
}
