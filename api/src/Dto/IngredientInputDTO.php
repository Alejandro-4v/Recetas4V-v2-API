<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class IngredientInputDTO
{
    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Length(max: 255)]
    public ?string $name = null;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Positive]
    public ?int $quantity = null;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Length(max: 25)]
    public ?string $unit = null;

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
}
