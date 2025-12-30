<?php

namespace App\Controller;

use App\Repository\NutrientTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class NutrientTypesController extends AbstractController
{
    #[Route('/nutrient-types', name: 'app_nutrient_types', methods: ['GET'])]
    public function index(NutrientTypeRepository $nutrientTypesRepository): JsonResponse
    {
        return $this->json($nutrientTypesRepository->findAll(), context: ['groups' => ['nutrients:read']]);
    }
}
