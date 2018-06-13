<?php

declare(strict_types=1);

namespace App\Controller\Admin\User;

use App\Entity\User;
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
     * @Route("/admin/user", name="admin.user.index")
     * @Template("admin/user/index.htm.twig")
     */
    public function __invoke(): array
    {
        return [
            'users' => $this->objectManager->getRepository(User::class)->findAll(),
        ];
    }
}
