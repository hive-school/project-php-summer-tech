<?php

namespace BionicUniversity\Bundle\CatalogBundle\Controller;

use BionicUniversity\Bundle\CatalogBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package BionicUniversity\Bundle\CatalogBundle\Controller
 * @Route("/category")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/{name}", name="category_index")
     * @ParamConverter(class="BionicUniversity\Bundle\CatalogBundle\Entity\Category")
     * @Template()
     *
     * @param Category $category
     * @return array
     */
    public function indexAction(Category $category)
    {
        return array('category' => $category);
    }
}
