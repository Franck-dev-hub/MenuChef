<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class RecipesEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: IngredientEntity::class, cascade: ['persist'])]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function setIngredients(iterable $ingredients): self
    {
        if (is_array($ingredients)) {
            $this->ingredients = new ArrayCollection($ingredients);
        }

        return $this;
    }
}
