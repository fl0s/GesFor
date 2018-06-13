<?php

declare(strict_types=1);

namespace App\Controller\Admin\Office;

use App\Entity\Office;
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
     * @Route("/admin/office", name="admin.office.index")
     * @Template("admin/office/index.htm.twig")
     */
    public function __invoke(): array
    {
        return [
            'offices' => $this->objectManager->getRepository(Office::class)->findAll(),
        ];
    }
}
