<?php

namespace App\Entity;

use App\Repository\NutrientTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NutrientTypeRepository::class)]
class NutrientType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nutrients:read', 'recipe:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nutrients:read', 'recipe:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nutrients:read', 'recipe:read'])]
    private ?string $unit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }
}
