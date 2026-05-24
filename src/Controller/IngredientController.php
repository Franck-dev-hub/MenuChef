<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredients', name: 'ingredients', methods: ['GET', 'POST'])]
    public function Ingredients(IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->findBy([], ['id' => 'ASC']);

        if (!$ingredients) {
            $ingredients = [];
        }

        return $this->render('ingredient/ingredient.html.twig', [
            'page_title' => 'Ingredients',
            'ingredients' => $ingredients,
        ]);
    }
}
