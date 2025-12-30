<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RecipeInputDTO
{
    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Length(min: 3, max: 255)]
    public ?string $title = null;

    #[Assert\NotBlank(groups: ['create'])]
    #[Assert\Positive]
    public ?int $numberDiner = null;

    #[Assert\NotBlank(groups: ['create'])]
    public ?int $typeId = null;

    /** @var IngredientInputDTO[] */
    #[Assert\Valid]
    public array $ingredients = [];

    /** @var StepInputDTO[] */
    #[Assert\Valid]
    public array $steps = [];

    /** @var NutrientInputDTO[] */
    #[Assert\Valid]
    public array $nutrients = [];

    /**
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return RecipeInputDTO
     */
    public function setTitle(?string $title): RecipeInputDTO {
        $this->title = $title;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberDiner(): ?int {
        return $this->numberDiner;
    }

    /**
     * @param int|null $numberDiner
     * @return RecipeInputDTO
     */
    public function setNumberDiner(?int $numberDiner): RecipeInputDTO {
        $this->numberDiner = $numberDiner;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTypeId(): ?int {
        return $this->typeId;
    }

    /**
     * @param int|null $typeId
     * @return RecipeInputDTO
     */
    public function setTypeId(?int $typeId): RecipeInputDTO {
        $this->typeId = $typeId;
        return $this;
    }

    /**
     * @return array
     */
    public function getIngredients(): array {
        return $this->ingredients;
    }

    /**
     * @param array $ingredients
     * @return RecipeInputDTO
     */
    public function setIngredients(array $ingredients): RecipeInputDTO {
        $this->ingredients = $ingredients;
        return $this;
    }

    /**
     * @return array
     */
    public function getSteps(): array {
        return $this->steps;
    }

    /**
     * @param array $steps
     * @return RecipeInputDTO
     */
    public function setSteps(array $steps): RecipeInputDTO {
        $this->steps = $steps;
        return $this;
    }

    /**
     * @return array
     */
    public function getNutrients(): array {
        return $this->nutrients;
    }

    /**
     * @param array $nutrients
     * @return RecipeInputDTO
     */
    public function setNutrients(array $nutrients): RecipeInputDTO {
        $this->nutrients = $nutrients;
        return $this;
    }

}
