<?php

namespace BionicUniversity\Bundle\ProductBundle\Form;

use BionicUniversity\Bundle\ProductBundle\Entity\Product;
use BionicUniversity\Bundle\ProductBundle\Form\Product\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('category')
            ->add('price')
            ->add('status')
            ->add('image')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bionicuniversity_bundle_productbundle_product';
    }

    public static function upload(Product $product)
    {
        if (null === $product->getImage()) {
            return;
        }

        $newName = md5($product->getImage()->getClientOriginalName() . time()) . "." . $product->getImage()->getClientOriginalExtension();
        $product->getImage()->move(
            'upload',
            $newName
        );

        $product->setPath($newName);
    }
}
