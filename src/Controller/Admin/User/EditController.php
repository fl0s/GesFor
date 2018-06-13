<?php

declare(strict_types=1);

namespace App\Controller\Admin\User;

use App\Entity\User;
use App\Form\OfficeType;
use App\Form\UserType;
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
     * @Route("/admin/user/{user}", requirements={"user": "\d+"}, name="admin.user.edit")
     * @Template("admin/user/edit.htm.twig")
     */
    public function __invoke(User $user, Request $request, Session $session): array
    {
        $form = $this->formFactory->create(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->flush();

            $session->getFlashBag()->add('success', $this->translator->trans('user.form.flash.success.edit'));
        }

        return [
            'form' => $form->createView(),
            'user' => $user,
        ];
    }
}
