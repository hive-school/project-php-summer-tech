<?php

namespace BionicUniversity\Bundle\UserBundle\Controller;

use BionicUniversity\Bundle\UserBundle\Entity\Role;
use BionicUniversity\Bundle\UserBundle\Form\SignUpType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BionicUniversity\Bundle\UserBundle\Entity\User;
use BionicUniversity\Bundle\UserBundle\Form\UserType;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/sign-up", name="user_sign_up")
     * @Template("BionicUniversityUserBundle:User:sign-up.html.twig")
     */
    public function signUpAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new SignUpType(), $entity);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $role = $em->getRepository('BionicUniversityUserBundle:Role')->findOneByRole('ROLE_USER');
                if (! $role) {
                    $role = new Role();
                    $role->setName('User');
                    $role->setRole('ROLE_USER');
                    $em->persist($role);
                }
                $entity->addRole($role);
                $entity->setIsActive(true);
                $em->persist($entity);

                $em->flush();

                $request->getSession()->getFlashBag()->add('Message', 'User successfully sign up');

                return $this->redirect($this->generateUrl('user_sign_in'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/sign-in", name="user_sign_in")
     * @Template("BionicUniversityUserBundle:User:sign-in.html.twig")
     */
    public function signInAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $error,
        );
    }

    /**
     * @Route("/sign-in-check", name="user_sign_in_check")
     */
    public function signInCheckAction()
    {
        return;
    }

    /**
     * @Route("/sign-out", name="user_sign_out")
     */
    public function signOutAction()
    {
        return;
    }
}
