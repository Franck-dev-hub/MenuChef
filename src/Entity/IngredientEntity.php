<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class IngredientEntity
{
    #[ORM\ManyToMany(targetEntity: RecipesEntity::class, mappedBy: 'ingredients')]
    private Collection $recipes;

    public function __construct(?string $name = null)
    {
        $this->recipes = new ArrayCollection();
        if (null !== $name) {
            $this->name = $name;
        }
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }

    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name = null;

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

    public function getRecipes(): Collection
    {
        return $this->recipes;
    }
}
