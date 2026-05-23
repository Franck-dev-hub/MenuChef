<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredients', name: 'ingredient', methods: ['GET'])]
    public function Ingredient(IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->findAllIngredients();

        if (!$ingredients) {
            throw $this->createNotFoundException('Ingredient not found');
        }

        return $this->render('ingredient/ingredient.html.twig', [
            'page_title' => 'Ingredient',
            'ingredients' => $ingredients,
        ]);
    }
}
