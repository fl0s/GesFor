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

class AddController
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
     * @Route("/admin/office/new", name="admin.office.add")
     * @Template("admin/office/add.htm.twig")
     */
    public function __invoke(Request $request, Session $session): array
    {
        $office = new Office();

        $form = $this->formFactory->create(OfficeType::class, $office);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($office);
            $this->objectManager->flush();

            $session->getFlashBag()->add('success', $this->translator->trans('office.form.flash.success.add'));
        }

        return [
            'form' => $form->createView(),
            'office' => $office,
        ];
    }
}
