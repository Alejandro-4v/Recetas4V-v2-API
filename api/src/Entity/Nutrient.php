<?php

namespace App\Entity;

use App\Repository\NutrientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NutrientRepository::class)]
class Nutrient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['recipe:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['recipe:read'])]
    private ?NutrientType $type = null;

    #[ORM\Column]
    #[Groups(['recipe:read'])]
    private ?float $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'nutrients')]
    private ?Recipe $recipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return NutrientType|null
     */
    public function getType(): ?NutrientType {
        return $this->type;
    }

    /**
     * @param NutrientType|null $type
     */
    public function setType(?NutrientType $type): void {
        $this->type = $type;
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
