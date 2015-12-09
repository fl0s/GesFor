<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stagiaire;
use AppBundle\Form\Stagiaire\StagiaireCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminStagiaireManuController
 * @package AppBundle\Controller
 * @Route("/gestion/stagiaire")
 */
class AdminStagiaireManuController extends Controller
{
    /**
     * @param Request $request
     * @Route("/create/{idFormation}", name="admin.stagiaire.create")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, $idFormation)
    {
        $formation = $this->getDoctrine()->getManager()->getRepository("AppBundle:Formation")->find($idFormation);

        if (is_null($formation)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'ajouter un client sur une formation inexistante!");

            return $this->redirectToRoute('admin.formation');
        }

        if (count($formation->getStagiaires()) >= $formation->getType()->getMaxPlace()) {
            $this->get('braincrafted_bootstrap.flash')->error("La formation est pleine!");
            return $this->redirectToRoute('admin.formation.view', array('id' => $formation->getId()));
        }

        $stagiaire = new Stagiaire();
        $stagiaire->setFormation($formation);

        $form = $this->createForm(new StagiaireCreateType(), $stagiaire);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stagiaire);
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success("Un nouveau client a été ajouté");
            return $this->redirectToRoute('admin.formation.view', array('id' => $formation->getId()));
        }

        return $this->render("admin/stagiaire/create.html.twig", array(
            'form'      => $form->createView(),
            'formation' => $formation
        ));
    }
}