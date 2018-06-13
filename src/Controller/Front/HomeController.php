<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Course;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/", name="front.home")
     * @Template("front/home.html.twig")
     */
    public function __invoke(): array
    {
        $courses = $this->objectManager->getRepository(Course::class)->findAll();

        return [
            'courses' => $courses,
        ];
    }
}
