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
     * @Route("/admin/course/new", name="admin.course.add")
     * @Template("admin/course/add.htm.twig")
     */
    public function __invoke(Request $request, Session $session): array
    {
        $course = new Course();

        $form = $this->formFactory->create(CourseType::class, $course);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($course);
            $this->objectManager->flush();

            $session->getFlashBag()->add('success', $this->translator->trans('course.form.flash.success.add'));
        }

        return [
            'form' => $form->createView(),
            'course' => $course,
        ];
    }
}
