<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $quantity = null;

    #[ORM\Column(length: 25)]
    private ?string $unit = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    private ?Recipe $recipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void {
        $this->name = $name;
    }

    /**
     * @return float|null
     */
    public function getQuantity(): ?float {
        return $this->quantity;
    }

    /**
     * @param float|null $quantity
     */
    public function setQuantity(?float $quantity): void {
        $this->quantity = $quantity;
    }

    /**
     * @return string|null
     */
    public function getUnit(): ?string {
        return $this->unit;
    }

    /**
     * @param string|null $unit
     */
    public function setUnit(?string $unit): void {
        $this->unit = $unit;
    }

    /**
     * @return Recipe|null
     */
    public function getRecipe(): ?Recipe {
        return $this->recipe;
    }

    /**
     * @param Recipe|null $recipe
     */
    public function setRecipe(?Recipe $recipe): void {
        $this->recipe = $recipe;
    }

}
