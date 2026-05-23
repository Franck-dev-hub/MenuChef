<?php

namespace App\Controller;

use App\Entity\RecipesEntity;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipesController extends AbstractController
{
    #[Route('/recipes', name: 'recipes', methods: ['GET', 'POST'])]
    public function Recipes(EntityManagerInterface $entityManager, Request $request, RecipeRepository $recipeRepository): Response
    {
        $newRecipe = new RecipesEntity();
        $form = $this->createForm(RecipeType::class, $newRecipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newRecipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipes');
        }

        $recipes = $recipeRepository->findBy([], ['id' => 'ASC']);

        if (!$recipes) {
            $recipes = [];
        }

        return $this->render('recipes/recipes.html.twig', [
            'page_title' => 'Recipes',
            'recipes' => $recipes,
            'form' => $form->createView(),
        ]);
    }
}
