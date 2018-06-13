<?php

declare(strict_types=1);

namespace App\Controller\Admin\Course;

use App\Entity\Course;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController
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
     * @Route("/admin/course", name="admin.course.index")
     * @Template("admin/course/index.htm.twig")
     */
    public function __invoke(): array
    {
        return [
            'courses' => $this->objectManager->getRepository(Course::class)->findAll(),
        ];
    }
}
