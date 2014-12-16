<?php

namespace BionicUniversity\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SignUpType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', [
                'error_bubbling' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('password', 'password', [
                'error_bubbling' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('email', 'email', [
                'error_bubbling' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('signUp', 'submit', [
                'attr' => [
                    'class' => 'btn btn-success pull-right',
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BionicUniversity\Bundle\UserBundle\Entity\User',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bionicuniversity_bundle_userbundle_user';
    }
}
