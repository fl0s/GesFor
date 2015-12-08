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
     * @Route("/{id}/edit", name="admin.type.edit")
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

    /**
     * @Route("/{id}/archive", name="admin.type.archive")
     */
    public function archiveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository("AppBundle:TypeFormation")->find($id);

        if (is_null($type)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'archiver la formation demandée!");
            return $this->redirectToRoute('admin.type');
        }

        $type->setArchived(true);
        $em->flush();

        $this->get('braincrafted_bootstrap.flash')->success("La formation ".$type->getTitre()." a bien été archivée!");
        return $this->redirectToRoute('admin.type');
    }

    /**
     * @Route("/{id}/activer", name="admin.type.activer")
     */
    public function activeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $type = $em->getRepository("AppBundle:TypeFormation")->find($id);

        if (is_null($type)) {
            $this->get('braincrafted_bootstrap.flash')->error("Impossible d'activer la formation demandée!");
            return $this->redirectToRoute('admin.type');
        }

        $type->setArchived(false);
        $em->flush();

        $this->get('braincrafted_bootstrap.flash')->success("La formation ".$type->getTitre()." a bien été activée!");
        return $this->redirectToRoute('admin.type');
    }
}
