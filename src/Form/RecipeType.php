<?php

namespace App\Form;

use App\Entity\IngredientEntity;
use App\Entity\RecipesEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('ingredients', TextType::class, [
                'required' => false,
            ])
        ;

        $builder->get('ingredients')->addViewTransformer(new CallbackTransformer(
            // Array -> String
            function ($ingredientsAsArray): string {
                if (empty($ingredientsAsArray)) {
                    return '';
                }

                $names = [];
                foreach ($ingredientsAsArray as $ingredient) {
                    $names[] = $ingredient->getName();
                }

                return implode(', ', $names);
            },

            // String -> Array
            function (?string $ingredientsAsString): array {
                if (empty($ingredientsAsString)) {
                    return [];
                }
                $names = array_filter(
                    array_map('trim', preg_split('/[\s,]+/', $ingredientsAsString)),
                    fn ($name) => '' !== $name
                );
                $ingredientsEntities = [];

                $repository = $this->entityManager->getRepository(IngredientEntity::class);

                foreach ($names as $name) {
                    if (empty($name)) {
                        continue;
                    }
                    $ingredient = $repository->findOneBy(['name' => $name]);

                    if (!$ingredient) {
                        $ingredient = new IngredientEntity();
                        $ingredient->setName($name);
                        $this->entityManager->persist($ingredient);
                    }

                    $ingredientsEntities[] = $ingredient;
                }

                return $ingredientsEntities;
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecipesEntity::class,
        ]);
    }
}
