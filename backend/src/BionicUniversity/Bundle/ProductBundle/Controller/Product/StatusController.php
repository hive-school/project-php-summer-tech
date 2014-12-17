<?php

namespace BionicUniversity\Bundle\ProductBundle\Controller\Product;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BionicUniversity\Bundle\ProductBundle\Entity\Product\Status;
use BionicUniversity\Bundle\ProductBundle\Form\Product\StatusType;

/**
 * Product\Status controller.
 *
 * @Route("/admin/product_status")
 */
class StatusController extends Controller
{

    /**
     * Lists all Product\Status entities.
     *
     * @Route("/", name="product_status")
     * @Method("GET")
     * @Template("BionicUniversityProductBundle:Product/Status:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BionicUniversityProductBundle:Product\Status')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Product\Status entity.
     *
     * @Route("/", name="product_status_create")
     * @Method("POST")
     * @Template("BionicUniversityProductBundle:Product\Status:new.html.twig")
     */
    public function createAction(Request $request)
    {

        $entity = new Status();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_status_show', array('id' => $entity->getId())));
        }

        return array(
//            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Product\Status entity.
     *
     * @param Status $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Status $entity)
    {
        $form = $this->createForm(new StatusType(), $entity, array(
            'action' => $this->generateUrl('product_status_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Product\Status entity.
     *
     * @Route("/new", name="product_status_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {

        $entity = new Status();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Product\Status entity.
     *
     * @Route("/{id}", name="product_status_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityProductBundle:Product\Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product\Status entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Product\Status entity.
     *
     * @Route("/{id}/edit", name="product_status_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityProductBundle:Product\Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product\Status entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Product\Status entity.
    *
    * @param Status $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Status $entity)
    {
        $form = $this->createForm(new StatusType(), $entity, array(
            'action' => $this->generateUrl('product_status_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Product\Status entity.
     *
     * @Route("/{id}", name="product_status_update")
     * @Method("PUT")
     * @Template("BionicUniversityProductBundle:Product\Status:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityProductBundle:Product\Status')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product\Status entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('product_status_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Product\Status entity.
     *
     * @Route("/{id}", name="product_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BionicUniversityProductBundle:Product\Status')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product\Status entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('product_status'));
    }

    /**
     * Creates a form to delete a Product\Status entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_status_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
