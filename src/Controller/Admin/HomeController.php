<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController
{
    /**
     * @Route("/admin/", name="admin.home")
     * @Template("admin/home.html.twig")
     */
    public function __invoke(): array
    {
        return [];
    }
}
