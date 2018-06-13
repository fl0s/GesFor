<?php

declare(strict_types=1);

namespace App\Controller\Admin\Trainee;

use App\Entity\Trainee;
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
     * @Route("/admin/trainee", name="admin.trainee.index")
     * @Template("admin/trainee/index.htm.twig")
     */
    public function __invoke(): array
    {
        return [
            'trainees' => $this->objectManager->getRepository(Trainee::class)->findAll(),
        ];
    }
}
