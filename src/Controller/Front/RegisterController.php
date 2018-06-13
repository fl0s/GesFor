<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Course;
use App\Entity\Trainee;
use App\Form\TraineeType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

class RegisterController
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
     * @Route("/course/{course}/register", requirements={"course": "[0-9a-f\-]+"}, name="front.course.registration")
     * @Template("front/register.html.twig")
     */
    public function __invoke(Course $course, Request $request): array
    {
        $trainee = new Trainee($course);
        $form = $this->formFactory->create(TraineeType::class, $trainee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->objectManager->persist($trainee);
            $this->objectManager->flush();
        }

        return [
            'course' => $course,
            'form' => $form->createView(),
        ];
    }
}
