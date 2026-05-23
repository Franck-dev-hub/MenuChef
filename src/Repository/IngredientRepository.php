<?php

namespace App\Repository;

use App\Model\Ingredient;

class IngredientRepository
{
    public function findAllIngredients(): array
    {
        return [
            new Ingredient(
                1,
                'Tomato'
            ),
            new Ingredient(
                2,
                'Mozzarella'
            ),
            new Ingredient(
                3,
                'Leek'
            ),
        ];
    }

    public function findIngredients(int $id): ?Ingredient
    {
        foreach ($this->findAllIngredients() as $recipe) {
            if ($recipe->getId() === $id) {
                return $recipe;
            }
        }

        return null;
    }
}
