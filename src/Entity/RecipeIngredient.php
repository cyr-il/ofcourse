<?php

namespace App\Entity;

use App\Repository\RecipeIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Recipe;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RecipeIngredientRepository::class)
 */
class RecipeIngredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipeIngredients")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class)
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     * @Groups({"recipe_list"})
     */
    private $ingredient;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"recipe_list"})
     */
    private $quantity;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    
    public function setQuantity(?int $quantity): self
    {   
        $this->quantity = $quantity;
        return $this;
    }

}
