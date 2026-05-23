<?php

namespace App\Controller\auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class loginController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['GET'])]
    public function Login(): Response
    {
        return $this->render('auth/login/login.html.twig', [
            'page_title' => 'Login',
        ]);
    }
}
