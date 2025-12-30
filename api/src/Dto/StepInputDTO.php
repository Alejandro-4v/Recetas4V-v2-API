<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class StepInputDTO
{
    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Positive]
    public ?int $stepOrder = null;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Length(max: 255)]
    public ?string $description = null;

    /**
     * @return int|null
     */
    public function getStepOrder(): ?int {
        return $this->stepOrder;
    }

    /**
     * @param int|null $stepOrder
     * @return StepInputDTO
     */
    public function setStepOrder(?int $stepOrder): StepInputDTO {
        $this->stepOrder = $stepOrder;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return StepInputDTO
     */
    public function setDescription(?string $description): StepInputDTO {
        $this->description = $description;
        return $this;
    }
}
