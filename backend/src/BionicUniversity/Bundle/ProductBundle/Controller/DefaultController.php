<?php

namespace BionicUniversity\Bundle\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BionicUniversityProductBundle:Default:subcategoryProducts.html.twig', array('name' => $name));
    }
}
