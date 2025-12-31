<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class NutrientInputDTO
{
    #[Assert\NotBlank(groups: ['create'])]
    public ?int $typeId = null;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Positive]
    public ?float $quantity = null;

    /**
     * @return int|null
     */
    public function getTypeId(): ?int {
        return $this->typeId;
    }

    /**
     * @param int|null $typeId
     */
    public function setTypeId(?int $typeId): void {
        $this->typeId = $typeId;
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

}
