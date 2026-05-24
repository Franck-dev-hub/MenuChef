<?php

namespace App\Controller\settings;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class toggleThemeController extends AbstractController
{
    #[Route('/toggleTheme', name: 'toggleTheme')]
    public function toggleTheme(Request $request): Response
    {
        $theme = $request->cookies->get('theme', 'light');
        $newTheme = 'light' === $theme ? 'dark' : 'light';

        $referer = $request->headers->get('referer', '/');
        $response = new RedirectResponse($referer);
        $response->headers->setCookie(new Cookie('theme', $newTheme));

        return $response;
    }
}
