<?php

namespace App\Controller\auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class registerController extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['GET'])]
    public function Register(): Response
    {
        return $this->render('auth/register/register.html.twig', [
            'page_title' => 'Register',
        ]);
    }
}
