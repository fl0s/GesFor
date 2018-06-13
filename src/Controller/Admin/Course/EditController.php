<?php

declare(strict_types=1);

namespace App\Controller\Admin\Course;

use App\Entity\Course;
use App\Form\CourseType;
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
     * @Route("/admin/course/{course}", requirements={"course": "[0-9a-f\-]+"}, name="admin.course.edit")
     * @Template("admin/course/edit.htm.twig")
     */
    public function __invoke(Course $course, Request $request, Session $session): array
    {
        $form = $this->formFactory->create(CourseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->flush();

            $session->getFlashBag()->add('success', $this->translator->trans('course.form.flash.success.edit'));
        }

        return [
            'form' => $form->createView(),
            'course' => $course,
        ];
    }
}
