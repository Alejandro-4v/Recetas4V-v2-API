<?php

namespace App\Controller;

use App\Repository\NutrientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class NutrientTypesController extends AbstractController
{
    #[Route('/nutrient-types', name: 'app_nutrient_types', methods: ['GET'])]
    public function index(NutrientRepository $nutrientRepository): JsonResponse
    {
        return $this->json($nutrientRepository->findAll());
    }
}
