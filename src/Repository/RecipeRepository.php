<?php

namespace App\Repository;

use App\Model\Recipe;

class RecipeRepository
{
    public function findAllRecipes(): array
    {
        return [
            new Recipe(
                1,
                'Tartiflette'
            ),
            new Recipe(
                2,
                'Pizza'
            ),
            new Recipe(
                3,
                'Salade de riz'
            ),
        ];
    }

    public function findRecipes(int $id): ?Recipe
    {
        foreach ($this->findAllRecipes() as $recipe) {
            if ($recipe->getId() === $id) {
                return $recipe;
            }
        }

        return null;
    }
}
