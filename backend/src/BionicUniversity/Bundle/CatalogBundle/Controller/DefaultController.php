<?php

namespace BionicUniversity\Bundle\CatalogBundle\Controller;

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
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
}
