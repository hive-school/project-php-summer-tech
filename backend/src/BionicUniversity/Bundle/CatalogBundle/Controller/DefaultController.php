<?php

namespace BionicUniversity\Bundle\CatalogBundle\Controller;

use BionicUniversity\Bundle\CatalogBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


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
     * @param Category $category
     * @return mixed
     */
    public function indexAction(Request $request, Category $category, $name)
    {
        $children = $category->getChildren();
        $paginator = $this->get('knp_paginator');
        if ($children->count() > 0) {
            $pagination = $paginator->paginate(
                $children,
                $request->query->get('page', 1)/*page number*/,
                2/*limit per page*/
            );
            return $this->render('BionicUniversityCatalogBundle:Default:subcategories.html.twig', array(
                'pagination' => $pagination,
                'category' => $category
            ));
        }

        return $this->redirect($this->generateUrl('category_products_show', array(
            'name' => $category,
        )));
    }

    /**
     * @Route("/products/{name}", name="category_products_show")
     * @param Request $request
     * @param Category $category
     * @return mixed
     */
    public function showProductsAction(Request $request, Category $category)
    {

        $products = $category->getProducts();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products,
            $request->query->get('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('BionicUniversityCatalogBundle:Default:subcategoryProducts.html.twig', array(
            'pagination' => $pagination,
            'category' => $category
        ));
    }

    /**
     * @Route("/{categoryName}/product/{productId}")
     * @param Request $request
     * @param $categoryName
     * @param $productId
     * @return mixed
     */
    public function showProduct(Request $request, $categoryName, $productId)
    {
        $om = $this->getDoctrine()->getRepository('BionicUniversityProductBundle:Product');
        $product = $om->find($productId);
        return $this->render('BionicUniversityCatalogBundle:Default:product.html.twig', array(
            'product' => $product
        ));
    }
}
