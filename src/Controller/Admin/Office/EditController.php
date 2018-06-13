<?php

declare(strict_types=1);

namespace App\Controller\Admin\Office;

use App\Entity\Office;
use App\Form\OfficeType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

class EditController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        FormFactoryInterface $formFactory,
        ObjectManager $objectManager,
        TranslatorInterface $translator
    ) {
        $this->formFactory = $formFactory;
        $this->objectManager = $objectManager;
        $this->translator = $translator;
    }

    /**
     * @Route("/admin/office/{office}", requirements={"office": "\d+"}, name="admin.office.edit")
     * @Template("admin/office/edit.htm.twig")
     */
    public function __invoke(Office $office, Request $request, Session $session): array
    {
        $form = $this->formFactory->create(OfficeType::class, $office);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->flush();

            $session->getFlashBag()->add('success', $this->translator->trans('office.form.flash.success.edit'));
        }

        return [
            'form' => $form->createView(),
            'office' => $office,
        ];
    }
}
