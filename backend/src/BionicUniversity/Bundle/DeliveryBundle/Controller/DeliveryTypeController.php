<?php

namespace BionicUniversity\Bundle\DeliveryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BionicUniversity\Bundle\DeliveryBundle\Entity\DeliveryType;
use BionicUniversity\Bundle\DeliveryBundle\Form\DeliveryTypeType;

/**
 * DeliveryType controller.
 *
 * @Route("/admin/delivery/type")
 */
class DeliveryTypeController extends Controller
{

    /**
     * Lists all DeliveryType entities.
     *
     * @Route("/", name="delivery_type")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryType')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DeliveryType entity.
     *
     * @Route("/", name="delivery_type_create")
     * @Method("POST")
     * @Template("BionicUniversityDeliveryBundle:DeliveryType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DeliveryType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_type_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a DeliveryType entity.
     *
     * @param DeliveryType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DeliveryType $entity)
    {
        $form = $this->createForm(new DeliveryTypeType(), $entity, array(
            'action' => $this->generateUrl('delivery_type_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DeliveryType entity.
     *
     * @Route("/new", name="delivery_type_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DeliveryType();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DeliveryType entity.
     *
     * @Route("/{id}", name="delivery_type_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeliveryType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DeliveryType entity.
     *
     * @Route("/{id}/edit", name="delivery_type_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeliveryType entity.');
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
    * Creates a form to edit a DeliveryType entity.
    *
    * @param DeliveryType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DeliveryType $entity)
    {
        $form = $this->createForm(new DeliveryTypeType(), $entity, array(
            'action' => $this->generateUrl('delivery_type_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DeliveryType entity.
     *
     * @Route("/{id}", name="delivery_type_update")
     * @Method("PUT")
     * @Template("BionicUniversityDeliveryBundle:DeliveryType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeliveryType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('delivery_type_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DeliveryType entity.
     *
     * @Route("/{id}", name="delivery_type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BionicUniversityDeliveryBundle:DeliveryType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DeliveryType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('delivery_type'));
    }

    /**
     * Creates a form to delete a DeliveryType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delivery_type_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
