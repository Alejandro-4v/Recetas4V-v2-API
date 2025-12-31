<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['recipe:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['recipe:read'])]
    private ?string $title = null;

    #[ORM\Column]
    #[SerializedName('number-diner')]
    #[Groups(['recipe:read'])]
    private ?int $numberDiner = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[SerializedName('type')]
    #[Groups(['recipe:read'])]
    private ?RecipeType $type = null;

    /**
     * @var Collection<int, Ingredient>
     */
    #[ORM\OneToMany(targetEntity: Ingredient::class, mappedBy: 'recipe', cascade: ['persist', 'remove'])]
    #[Groups(['recipe:read'])]
    private Collection $ingredients;

    /**
     * @var Collection<int, Step>
     */
    #[ORM\OneToMany(targetEntity: Step::class, mappedBy: 'recipe', cascade: ['persist', 'remove'])]
    #[Groups(['recipe:read'])]
    private Collection $steps;

    /**
     * @var Collection<int, Nutrient>
     */
    #[ORM\OneToMany(targetEntity: Nutrient::class, mappedBy: 'recipe', cascade: ['persist', 'remove'])]
    #[Groups(['recipe:read'])]
    private Collection $nutrients;

    #[ORM\OneToMany(targetEntity: Rating::class, mappedBy: 'recipe', cascade: ['persist', 'remove'])]
    private Collection $ratings;

    public function __construct() {
        $this->ingredients = new ArrayCollection();
        $this->steps = new ArrayCollection();
        $this->nutrients = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static {
        $this->title = $title;

        return $this;
    }

    public function getNumberDiner(): ?int {
        return $this->numberDiner;
    }

    public function setNumberDiner(int $numberDiner): static {
        $this->numberDiner = $numberDiner;

        return $this;
    }

    public function getType(): ?RecipeType {
        return $this->type;
    }

    public function setType(?RecipeType $type): static {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Step>
     */
    public function getSteps(): Collection {
        return $this->steps;
    }

    public function addStep(Step $step): static {
        if (!$this->steps->contains($step)) {
            $this->steps->add($step);
            $step->setRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Nutrient>
     */
    public function getNutrients(): Collection {
        return $this->nutrients;
    }

    public function addNutrient(Nutrient $nutrient): static {
        if (!$this->nutrients->contains($nutrient)) {
            $this->nutrients->add($nutrient);
            $nutrient->setRecipe($this);
        }

        return $this;
    }

    public function getRatings(): Collection {
        return $this->ratings;
    }

    public function addRating(Rating $rating): void {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
        }
    }

}
