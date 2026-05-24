<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/dashboard', name: 'dashboard', methods: ['GET'])]
    public function Dashboard(): Response
    {
        return $this->render('dashboard/dashboard.html.twig', [
            'page_title' => 'Dashboard',
        ]);
    }
}
