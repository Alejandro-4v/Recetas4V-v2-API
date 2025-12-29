<?php

namespace App\Controller;

use App\Repository\RecipeTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class RecipeTypesController extends AbstractController
{
    #[Route('/recipe-types', name: 'app_recipe_types', methods: ['GET'])]
    public function index(RecipeTypeRepository $recipeTypeRepository): JsonResponse
    {
        return $this->json($recipeTypeRepository->findAll());
    }
}
