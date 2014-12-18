<?php

namespace BionicUniversity\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {

        return array();
    }

//    /**
//     * Finds and displays a Product entity.
//     *
//     * @Route("/product/{id}", name="web_product_show")
//     * @Template()
//     */
//    public function showAction($id)
//    {
//
//        $em = $this->getDoctrine()->getManager();
//
//        $entity = $em->getRepository('BionicUniversityProductBundle:Product')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Product entity.');
//        }
//
//
//        return array(
//            'entity'      => $entity,
//        );
//    }
}
