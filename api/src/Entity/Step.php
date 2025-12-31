<?php

namespace App\Entity;

use App\Repository\StepRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\SerializedName;

#[ORM\Entity(repositoryClass: StepRepository::class)]
class Step
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['recipe:read'])]
    private ?int $step_order = null;

    #[ORM\Column(length: 255)]
    #[Groups(['recipe:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'steps')]
    private ?Recipe $recipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStepOrder(): ?int
    {
        return $this->step_order;
    }

    public function setStepOrder(int $step_order): static
    {
        $this->step_order = $step_order;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): static
    {
        $this->recipe = $recipe;

        return $this;
    }
}
