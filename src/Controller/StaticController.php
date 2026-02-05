<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

final class StaticController extends AbstractController
{
    #[Route('/mentions-legales', name: 'app_mentions_legales')]
    public function mentions(): Response
    {
        return $this->render('static/mentions_legales.html.twig');
    }

    #[Route('/politique-confidentialite', name: 'app_politique_confidentialite')]
    public function rgpd(): Response
    {
        return $this->render('static/politique_confidentialite.html.twig');
    }

    #[Route('/cookies', name: 'app_cookies')]
    public function cookies(): Response
    {
        return $this->render('static/cookies.html.twig');
    }

    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('static/cgu.html.twig');
    }

    #[Route('/cgv', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('static/cgv.html.twig');
    }

    #[Route('/accessibilite', name: 'app_accessibilite')]
    public function accessibilite(): Response
    {
        return $this->render('static/accessibilite.html.twig');
    }


    #[Route('/test-403', name: 'test_403')]
    public function test403(): Response
    {
        //if j'ai les droit ok sinon ->
        throw new AccessDeniedException();
    } 

    #[Route('/test-401', name: 'test_401')]
    public function test401(): Response
    {
        //mauvaise identification ->
        throw new AuthenticationException();
    } 

    #[Route('/test-granted', name: 'test_granted'), IsGranted('ROLE_ADMIN')]
    public function method_granted(): Response
    {
        return $this->render('static/IsGranted.html.twig');
    }
}
