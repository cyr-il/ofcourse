<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"recipe_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recipe_list"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recipe_list"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"recipe_list"})
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"recipe_list"})
     */
    private $servings;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"recipe_list"})
     */
    private $private;

    /**
     * @ORM\OneToMany(targetEntity=RecipeIngredient::class, mappedBy="recipe", cascade={"persist"})
     * @Groups({"recipe_list"})
     */
    private $recipeIngredients;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="recipes", cascade={"persist"})
     * @Groups({"recipe_list"})
     */
    private $categories;

    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function setServings(int $servings): self
    {
        $this->servings = $servings;

        return $this;
    }

    public function getPrivate(): ?int
    {
        return $this->private;
    }

    public function setPrivate(int $private): self
    {
        $this->private = $private;

        return $this;
    }

    /**
     * @return Collection|RecipeIngredient[]
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients[] = $recipeIngredient;
            $recipeIngredient->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient): self
    {
        if ($this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->removeElement($recipeIngredient);
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getRecipe() === $this) {
                $recipeIngredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }
}
