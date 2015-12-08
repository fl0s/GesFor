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
     * @Route("/{id}/edit", name="admin.formation.edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository("AppBundle:TypeFormation")->find($id);

        if (is_null($type)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'editer le type de formation demandée!");
            return $this->redirectToRoute('admin.type');
        }

        $form = $this->createForm(new TypeFormationCreateType(), $type);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success("La formation ".$type->getTitre()." a bien été éditée!");

            return $this->redirectToRoute('admin.type');
        }

        return $this->render('admin/type/edit.html.twig',array(
            'form'      => $form->createView(),
            'type'   => $type
        ));
    }
}
