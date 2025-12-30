<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class NutrientInputDTO
{
    #[Assert\NotBlank(groups: ['create'])]
    public ?int $typeId = null;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Positive]
    public ?int $quantity = null;

    /**
     * @return int|null
     */
    public function getTypeId(): ?int {
        return $this->typeId;
    }

    /**
     * @param int|null $typeId
     * @return NutrientInputDTO
     */
    public function setTypeId(?int $typeId): NutrientInputDTO {
        $this->typeId = $typeId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     * @return NutrientInputDTO
     */
    public function setQuantity(?int $quantity): NutrientInputDTO {
        $this->quantity = $quantity;
        return $this;
    }

}
