<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Formation;
use AppBundle\Entity\TypeFormation;
use AppBundle\Form\Formation\FormationCreateType;
use AppBundle\Form\TypeFormation\TypeFormationCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class AdminFormationController
 * @package AppBundle\Controller
 * @Route("/gestion/formation")
 */
class AdminFormationController extends Controller
{
    /**
     * @Route("/", name="admin.formation")
     */
    public function indexAction(Request $request)
    {
        $formations = $this->getDoctrine()->getManager()->getRepository("AppBundle:Formation")->findAll();

        return $this->render('admin/formation/index.html.twig', array(
            'formations' => $formations,
        ));
    }

    /**
     * @Route("/create", name="admin.formation.create")
     */
    public function createAction(Request $request)
    {
        $formation = new Formation();

        $form = $this->createForm(new FormationCreateType(), $formation);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($formation);
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success("La nouvelle formation a bien été créée!");

            return $this->redirectToRoute('admin.formation');
        }

        return $this->render('admin/formation/create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}", name="admin.formation.view")
     */
    public function viewAction(Request $request, $id)
    {
        $formation = $this->getDoctrine()->getManager()->getRepository("AppBundle:Formation")->find($id);

        if (is_null($formation)) {
            $this->get('braincrafted_bootstrap.flash')->danger("La formation n'existe pas!");
            return $this->redirectToRoute('admin.formation');
        }

        return $this->render('admin/formation/view.html.twig', array(
            'formation' => $formation
        ));
    }

    /**
     * @Route("/{id}/edit", name="admin.formation.edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository("AppBundle:Formation")->find($id);

        if (is_null($formation)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'editer la formation demandée!");
            return $this->redirectToRoute('admin.formation');
        }

        $form = $this->createForm(new FormationCreateType(), $formation);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success("La formation ".$formation->getTitre()." a bien été éditée!");

            return $this->redirectToRoute('admin.formation');
        }

        return $this->render('admin/formation/edit.html.twig',array(
            'form'      => $form->createView(),
            'formation' => $formation
        ));
    }
}
