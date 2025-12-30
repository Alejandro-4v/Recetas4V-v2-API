<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;

final class RecipesController extends AbstractController
{
    #[Route('/recipes', name: 'app_recipes', methods: ['GET'])]
    public function index(RecipeRepository $recipeRepository, Request $request): JsonResponse
    {

        $type = $request->query->get('type');

        if ($type) {
            return $this->json($recipeRepository->findByType($type));
        }

        return $this->json($recipeRepository->findAll());
    }
}
