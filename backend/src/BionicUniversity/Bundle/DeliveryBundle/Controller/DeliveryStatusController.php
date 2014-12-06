<?php

namespace BionicUniversity\Bundle\DeliveryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BionicUniversity\Bundle\DeliveryBundle\Entity\DeliveryStatus;
use BionicUniversity\Bundle\DeliveryBundle\Form\DeliveryStatusType;

/**
 * DeliveryStatus controller.
 *
 * @Route("admin/delivery/status")
 */
class DeliveryStatusController extends Controller
{

    /**
     * Lists all DeliveryStatus entities.
     *
     * @Route("/", name="delivery_status")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryStatus')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DeliveryStatus entity.
     *
     * @Route("/", name="delivery_status_create")
     * @Method("POST")
     * @Template("BionicUniversityDeliveryBundle:DeliveryStatus:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DeliveryStatus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_status_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a DeliveryStatus entity.
     *
     * @param DeliveryStatus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DeliveryStatus $entity)
    {
        $form = $this->createForm(new DeliveryStatusType(), $entity, array(
            'action' => $this->generateUrl('delivery_status_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DeliveryStatus entity.
     *
     * @Route("/new", name="delivery_status_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DeliveryStatus();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DeliveryStatus entity.
     *
     * @Route("/{id}", name="delivery_status_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeliveryStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DeliveryStatus entity.
     *
     * @Route("/{id}/edit", name="delivery_status_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeliveryStatus entity.');
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
    * Creates a form to edit a DeliveryStatus entity.
    *
    * @param DeliveryStatus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DeliveryStatus $entity)
    {
        $form = $this->createForm(new DeliveryStatusType(), $entity, array(
            'action' => $this->generateUrl('delivery_status_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DeliveryStatus entity.
     *
     * @Route("/{id}", name="delivery_status_update")
     * @Method("PUT")
     * @Template("BionicUniversityDeliveryBundle:DeliveryStatus:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeliveryStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_status_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DeliveryStatus entity.
     *
     * @Route("/{id}", name="delivery_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryStatus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DeliveryStatus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('delivery_status'));
    }

    /**
     * Creates a form to delete a DeliveryStatus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delivery_status_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
