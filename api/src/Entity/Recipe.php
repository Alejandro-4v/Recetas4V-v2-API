<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    #[SerializedName('number-diner')]
    private ?int $numberDiner = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[SerializedName('type-id')]
    private ?RecipeType $type = null;

    /**
     * @var Collection<int, Ingredient>
     */
    #[ORM\OneToMany(targetEntity: Ingredient::class, mappedBy: 'recipe')]
    private Collection $ingredients;

    /**
     * @var Collection<int, Step>
     */
    #[ORM\OneToMany(targetEntity: Step::class, mappedBy: 'recipe')]
    private Collection $steps;

    /**
     * @var Collection<int, Nutrient>
     */
    #[ORM\OneToMany(targetEntity: Nutrient::class, mappedBy: 'recipe')]
    private Collection $nutrients;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?rating $rating = null;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->steps = new ArrayCollection();
        $this->nutrients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getNumberDiner(): ?int
    {
        return $this->numberDiner;
    }

    public function setNumberDiner(int $numberDiner): static
    {
        $this->numberDiner = $numberDiner;

        return $this;
    }

    public function getType(): ?RecipeType
    {
        return $this->type;
    }

    public function setType(?RecipeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Step>
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): static
    {
        if (!$this->steps->contains($step)) {
            $this->steps->add($step);
            $step->setRecipe($this);
        }

        return $this;
    }

    public function removeStep(Step $step): static
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getRecipe() === $this) {
                $step->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Nutrient>
     */
    public function getNutrients(): Collection
    {
        return $this->nutrients;
    }

    public function addNutrient(Nutrient $nutrient): static
    {
        if (!$this->nutrients->contains($nutrient)) {
            $this->nutrients->add($nutrient);
            $nutrient->setRecipe($this);
        }

        return $this;
    }

    public function removeNutrient(Nutrient $nutrient): static
    {
        if ($this->nutrients->removeElement($nutrient)) {
            // set the owning side to null (unless already changed)
            if ($nutrient->getRecipe() === $this) {
                $nutrient->setRecipe(null);
            }
        }

        return $this;
    }

    public function getRating(): ?rating
    {
        return $this->rating;
    }

    public function setRating(?rating $rating): static
    {
        $this->rating = $rating;

        return $this;
    }
}
