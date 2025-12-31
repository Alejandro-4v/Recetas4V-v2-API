<?php

namespace App\Controller;

use App\Dto\IngredientInputDTO;
use App\Dto\NutrientInputDTO;
use App\Dto\RecipeInputDTO;
use App\Dto\StepInputDTO;
use App\Entity\Ingredient;
use App\Entity\Nutrient;
use App\Entity\Recipe;
use App\Entity\Step;
use App\Repository\NutrientTypeRepository;
use App\Repository\RecipeRepository;
use App\Repository\RecipeTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RecipesController extends AbstractController {
    #[Route('/recipes', name: 'app_recipes', methods: ['GET'])]
    public function index(RecipeRepository $recipeRepository, Request $request): JsonResponse {

        $type = $request->query->get('type');

        if ($type) {
            return $this->json($recipeRepository->findByType($type));
        }

        return $this->json($recipeRepository->findAll(), context: ['groups' => ['recipe:read']]);
    }

    #[Route('/recipes', name: 'app_recipes_create', methods: ['POST'])]
    public function create(
        Request                $request,
        SerializerInterface    $serializer,
        ValidatorInterface     $validator,
        RecipeTypeRepository   $recipeTypeRepository,
        NutrientTypeRepository $nutrientTypeRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $json = $request->getContent();

        try {
            /** @var RecipeInputDTO $recipeDTO */
            $recipeDTO = $serializer->deserialize($json, RecipeInputDTO::class, 'json');
        } catch (Exception $e) {
            return new JsonResponse(['code' => '21', 'description' => $e->getMessage()], 400);
        } catch (ExceptionInterface $e) {
            return new JsonResponse(['code' => '21', 'description' => $e->getMessage()], 400);
        }

        $errors = $validator->validate($recipeDTO, groups: ['create']);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
            }
            return new JsonResponse(['code' => '21', 'description' => $errorMessages], 400);
        }

        $recipeType = $recipeTypeRepository->find($recipeDTO->typeId);
        if (!$recipeType) {
            return new JsonResponse(['code' => '21', 'description' => 'Recipe Type with ID ' . $recipeDTO->typeId . ' not found'], 404);
        }

        $recipe = new Recipe();
        $recipe->setTitle($recipeDTO->title);
        $recipe->setNumberDiner($recipeDTO->numberDiner);
        $recipe->setType($recipeType);

        foreach ($recipeDTO->ingredients as $ingredientDTO) {
            /** @var IngredientInputDTO $ingredientDTO */
            $ingredient = new Ingredient();
            $ingredient->setName($ingredientDTO->name);
            $ingredient->setQuantity($ingredientDTO->quantity);
            $ingredient->setUnit($ingredientDTO->unit);
            $recipe->addIngredient($ingredient);
        }

        foreach ($recipeDTO->steps as $stepDTO) {
            /** @var StepInputDTO $stepDTO */
            $step = new Step();
            $step->setStepOrder($stepDTO->stepOrder);
            $step->setDescription($stepDTO->description);
            $recipe->addStep($step);
        }

        foreach ($recipeDTO->nutrients as $nutrientDTO) {
            /** @var NutrientInputDTO $nutrientDTO */
            $nutrientType = $nutrientTypeRepository->find($nutrientDTO->typeId);
            if (!$nutrientType) {
                return new JsonResponse(['code' => '21', 'description' => 'Nutrient Type with ID ' . $nutrientDTO->typeId . ' not found'], 404);
            }

            $nutrient = new Nutrient();
            $nutrient->setType($nutrientType);
            $nutrient->setQuantity($nutrientDTO->quantity);
            $recipe->addNutrient($nutrient);
        }

        $entityManager->persist($recipe);
        $entityManager->flush();

        return $this->json($recipe, 200, context: ['groups' => ['recipe:read']]);
    }

    #[Route('/recipes/{recipeId}', name: 'app_recipes_delete', methods: ['DELETE'])]
    public function delete(RecipeRepository $recipeRepository, Request $request): JsonResponse {

        $id = $request->attributes->get('recipeId');

        $recipe = $recipeRepository->find($id);

        if (!$recipe) {
            return new JsonResponse(['code' => '21', 'description' => 'Recipe with ID ' . $id . ' not found'], 400);
        }

        $response = $this->json($recipe, 200, context: ['groups' => ['recipe:read']]);

        $recipeRepository->delete($recipe);

        return $response;

    }

    #[Route('/recipes/{recipeId}/rating/{rate}', name: 'app_recipes_update', methods: ['POST'])]
    public function updateRating(RecipeRepository $recipeRepository, Request $request): JsonResponse {

        $id = $request->attributes->get('recipeId');
        $rate = $request->attributes->get('rate');

        $recipe = $recipeRepository->find($id);

        if (!$recipe) {
            return new JsonResponse(['code' => '21', 'description' => 'Recipe with ID ' . $id . ' not found'], 400);
        }

        $recipe->setRating($rate);

        $recipeRepository->updateRating($recipe);

        return $this->json($recipe, 200, context: ['groups' => ['recipe:read']]);
    }
}
