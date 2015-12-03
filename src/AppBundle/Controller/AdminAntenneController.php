<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Antenne;
use AppBundle\Form\Antenne\AntenneCreateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminAntenneController extends Controller
{
    /**
     * @Route("/gestion/antenne", name="admin.antenne")
     */
    public function indexAction(Request $request)
    {
        $antennes = $this->getDoctrine()->getManager()->getRepository("AppBundle:Antenne")->findAll();

        return $this->render('admin/antenne/index.html.twig', array(
            'antenne' => $antennes,
        ));
    }

    /**
     * @Route("/gestion/antenne/create", name="admin.antenne.create")
     */
    public function createAction(Request $request)
    {
        $antenne = new Antenne();

        $form = $this->createForm(new AntenneCreateType(), $antenne);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($antenne);
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success("L'antenne de ".$antenne->getName()." a bien été créée!");

            return $this->redirectToRoute('admin.antenne');
        }

        return $this->render('admin/antenne/create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/gestion/antenne/{id}/create", name="admin.antenne.edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $antenne = $em->getRepository("AppBundle:Antenne")->find($id);

        if (is_null($antenne)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'editer l'antenne demandée!");
            return $this->redirectToRoute('admin.antenne');
        }

        $form = $this->createForm(new AntenneCreateType(), $antenne);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //$em->persist($antenne);
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success("L'antenne de ".$antenne->getName()." a bien été éditée!");

            return $this->redirectToRoute('admin.antenne');
        }

        return $this->render('admin/antenne/edit.html.twig',array(
            'form'      => $form->createView(),
            'antenne'   => $antenne
        ));
    }

    /**
     * @Route("/gestion/antenne/{id}/archive", name="admin.antenne.archive")
     */
    public function archiveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $antenne = $em->getRepository("AppBundle:Antenne")->find($id);

        if (is_null($antenne)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'archiver l'antenne demandée!");
            return $this->redirectToRoute('admin.antenne');
        }

        $antenne->setArchived(true);
        $em->persist($antenne);
        $em->flush();

        $this->get('braincrafted_bootstrap.flash')->success("L'antenne de ".$antenne->getName()." a bien été archivée!");
        return $this->redirectToRoute('admin.antenne');
    }

    /**
     * @Route("/gestion/antenne/{id}/activer", name="admin.antenne.activer")
     */
    public function activeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $antenne = $em->getRepository("AppBundle:Antenne")->find($id);

        if (is_null($antenne)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'activer l'antenne demandée!");
            return $this->redirectToRoute('admin.antenne');
        }

        $antenne->setArchived(false);
        $em->persist($antenne);
        $em->flush();

        $this->get('braincrafted_bootstrap.flash')->success("L'antenne de ".$antenne->getName()." a bien été activée!");
        return $this->redirectToRoute('admin.antenne');
    }
}
