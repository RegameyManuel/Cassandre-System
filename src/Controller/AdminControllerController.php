<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class AdminControllerController extends AbstractController
{
    #[Route('/admin/controller', name: 'app_admin_controller')]
    public function index(): Response
    {
        return $this->render('admin_controller/index.html.twig', [
            'controller_name' => 'AdminControllerController',
        ]);
    }

}
