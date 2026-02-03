<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DemoPloufController extends AbstractController
{
    #[Route('/demo/plouf', name: 'app_demo_plouf')]
    public function index(): Response
    {
        return $this->render('demo_plouf/index.html.twig', [
            'controller_name' => 'DemoPloufController',
        ]);
    }
}
