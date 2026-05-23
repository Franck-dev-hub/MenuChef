<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipesController extends AbstractController
{
    #[Route('/recipes', name: 'recipes', methods: ['GET'])]
    public function Recipes(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAllRecipes();

        if (!$recipes) {
            throw $this->createNotFoundException('Recipes not found');
        }

        return $this->render('recipes/recipes.html.twig', [
            'page_title' => 'Recipes',
            'recipes' => $recipes,
        ]);
    }
}
