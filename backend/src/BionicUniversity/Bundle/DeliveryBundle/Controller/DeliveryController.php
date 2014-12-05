<?php

namespace BionicUniversity\Bundle\DeliveryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BionicUniversity\Bundle\DeliveryBundle\Entity\Delivery;
use BionicUniversity\Bundle\DeliveryBundle\Form\DeliveryType;

/**
 * Delivery controller.
 *
 * @Route("/admin/delivery")
 */
class DeliveryController extends Controller
{

    /**
     * Lists all Delivery entities.
     *
     * @Route("/", name="delivery")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BionicUniversityDeliveryBundle:Delivery')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Delivery entity.
     *
     * @Route("/", name="delivery_create")
     * @Method("POST")
     * @Template("BionicUniversityDeliveryBundle:Delivery:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Delivery();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Delivery entity.
     *
     * @param Delivery $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Delivery $entity)
    {
        $form = $this->createForm(new DeliveryType(), $entity, array(
            'action' => $this->generateUrl('delivery_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Delivery entity.
     *
     * @Route("/new", name="delivery_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Delivery();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Delivery entity.
     *
     * @Route("/{id}", name="delivery_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:Delivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Delivery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Delivery entity.
     *
     * @Route("/{id}/edit", name="delivery_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:Delivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Delivery entity.');
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
    * Creates a form to edit a Delivery entity.
    *
    * @param Delivery $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Delivery $entity)
    {
        $form = $this->createForm(new DeliveryType(), $entity, array(
            'action' => $this->generateUrl('delivery_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Delivery entity.
     *
     * @Route("/{id}", name="delivery_update")
     * @Method("PUT")
     * @Template("BionicUniversityDeliveryBundle:Delivery:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:Delivery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Delivery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Delivery entity.
     *
     * @Route("/{id}", name="delivery_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BionicUniversityDeliveryBundle:Delivery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Delivery entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('delivery'));
    }

    /**
     * Creates a form to delete a Delivery entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delivery_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
