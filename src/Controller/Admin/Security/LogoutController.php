<?php

declare(strict_types=1);

namespace App\Controller\Admin\Security;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LogoutController
{
    /**
     * @Route("/admin/logout", name="admin.logout")
     */
    public function __invoke(): Response
    {
        return new Response();
    }
}
