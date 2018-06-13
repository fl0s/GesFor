<?php

declare(strict_types=1);

namespace App\Controller\Admin\Security;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController
{
    /**
     * @Route("/admin/login", name="admin.login")
     * @Template("admin/security/login.html.twig")
     */
    public function __invoke(AuthenticationUtils $authenticationUtils): array
    {
        return [
            'lastUsername' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ];
    }
}
