<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class dashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard', methods: ['GET'])]
    public function Dashboard(): Response
    {
        return $this->render('dashboard/dashboard.html.twig', [
            'page_title' => 'Dashboard',
        ]);
    }
}
