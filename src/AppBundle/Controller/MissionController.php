<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Mission;
use AppBundle\Form\MissionType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Mission controller.
 * @Route("/mission")
 */
class MissionController extends Controller
{
    /**
     * Lists all Mission entities.
     *
     * @Route("/", name="mission_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $pagelimit = $this->container->getParameter("pagination_limit");
        $em = $this->getDoctrine()->getManager();
        $missions = $em->getRepository('AppBundle:Mission')->findByCurrentUser($this->getUser());

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $missions,
            $request->query->getInt('page', 1), /*page number*/
            $pagelimit /*limit per page*/
        );


        return $this->render('mission/index.html.twig', array(
            'missions' => $pagination,
        ));
    }

    /**
     * Creates a new Mission entity.
     *
     * @Route("/new", name="mission_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if(!$this->getUser()->isClient()){
            throw new AccessDeniedHttpException("Only Clients can create new missions");
        }
        $mission = new Mission();
        $form = $this->createForm('AppBundle\Form\MissionType', $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mission);
            $em->flush();

            return $this->redirectToRoute('mission_show', array('id' => $mission->getId()));
        }

        return $this->render('mission/new.html.twig', array(
            'mission' => $mission,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Mission entity.
     *
     * @Route("/{id}", name="mission_show")
     * @Method("GET")
     */
    public function showAction(Mission $mission)
    {
        $deleteForm = $this->createDeleteForm($mission);

        return $this->render('mission/show.html.twig', array(
            'mission' => $mission,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Mission entity.
     *
     * @Route("/{id}/edit", name="mission_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Mission $mission)
    {
        $deleteForm = $this->createDeleteForm($mission);
        $editForm = $this->createForm('AppBundle\Form\MissionType', $mission);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mission);
            $em->flush();

            return $this->redirectToRoute('mission_edit', array('id' => $mission->getId()));
        }

        return $this->render('mission/edit.html.twig', array(
            'mission' => $mission,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Mission entity.
     *
     * @Route("/{id}", name="mission_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Mission $mission)
    {
        $form = $this->createDeleteForm($mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mission);
            $em->flush();
        }

        return $this->redirectToRoute('mission_index');
    }

    /**
     * Creates a form to delete a Mission entity.
     *
     * @param Mission $mission The Mission entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mission $mission)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mission_delete', array('id' => $mission->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
