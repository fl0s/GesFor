<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TypeFormation;
use AppBundle\Form\Antenne\AntenneCreateType;
use AppBundle\Form\TypeFormation\TypeFormationCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class AdminTypeController
 * @package AppBundle\Controller
 * @Route("/gestion/type")
 */
class AdminTypeController extends Controller
{
    /**
     * @Route("/", name="admin.type")
     */
    public function indexAction(Request $request)
    {
        $types = $this->getDoctrine()->getManager()->getRepository("AppBundle:TypeFormation")->findAll();

        return $this->render('admin/type/index.html.twig', array(
            'types' => $types,
        ));
    }

    /**
     * @Route("/create", name="admin.type.create")
     */
    public function createAction(Request $request)
    {
        $type = new TypeFormation();

        $form = $this->createForm(new TypeFormationCreateType(), $type);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($type);
            $em->flush();

            $this->get('braincrafted_bootstrap.flash')->success("Le nouveau type de formation a bien été créée!");

            return $this->redirectToRoute('admin.type');
        }

        return $this->render('admin/type/create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/create", name="admin.antenne.edit")
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
     * @Route("/{id}/archive", name="admin.antenne.archive")
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
     * @Route("/{id}/activer", name="admin.antenne.activer")
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
