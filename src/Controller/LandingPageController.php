<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LandingPageController extends AbstractController
{
    #[Route('/', name: 'landing_page', methods: ['GET'])]
    public function LandingPage(): Response
    {
        if ($this->getUser()) {
            return $this->redirect('/dashboard');
        }

        return $this->render('landingpage/landingpage.html.twig', [
            'page_title' => 'Menu Chef !',
        ]);
    }
}
