<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['recipe:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    private ?Recipe $recipe = null;

    #[ORM\Column(length: 45, unique: true)]
    #[Assert\Ip]
    private ?string $ip = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Range(min: 0, max: 5)]
    private ?float $rating = null;

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string {
        return $this->ip;
    }

    /**
     * @param string|null $ip
     */
    public function setIp(?string $ip): void {
        $this->ip = $ip;
    }

    /**
     * @return float|null
     */
    public function getRating(): ?float {
        return $this->rating;
    }

    /**
     * @param float|null $rating
     */
    public function setRating(?float $rating): void {
        $this->rating = $rating;
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
