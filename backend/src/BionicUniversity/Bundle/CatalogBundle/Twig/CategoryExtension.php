<?php
namespace BionicUniversity\Bundle\CatalogBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CategoryExtension
 * @package BionicUniversity\Bundle\CatalogBundle\Twig\Extension
 */
class CategoryExtension extends \Twig_Extension
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function setOm(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('categories', array($this, 'getCategories')),
        );
    }

    /**
     * @return array|\BionicUniversity\Bundle\CatalogBundle\Entity\Category[]
     */
    public function getCategories()
    {
        return $this->om->getRepository('BionicUniversityCatalogBundle:Category')->findAll();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'categories';
    }

}