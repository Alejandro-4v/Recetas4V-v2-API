<?php

namespace App\Command;

use App\Entity\NutrientType;
use App\Entity\RecipeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-mock-data',
    description: 'Populates the DB with mock data'
)]
class MockDataCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $recipeTypes = [
            ['Breakfast', 'Start your day right with these breakfast recipes'],
            ['Lunch', 'Delicious midday meals to keep you going'],
            ['Dinner', 'Satisfying evening meals for the whole family'],
            ['Dessert', 'Sweet treats to finish your meal'],
            ['Snack', 'Quick bites for in-between meals'],
            ['Appetizer', 'Starters to whet your appetite'],
            ['Salad', 'Fresh and healthy greens'],
            ['Soup', 'Warm and cozy soups for any weather'],
            ['Beverage', 'Refreshing drinks and smoothies'],
            ['Vegan', 'Plant-based recipes for a healthy lifestyle'],
        ];

        foreach ($recipeTypes as [$name, $description]) {
            $recipeType = new RecipeType();
            $recipeType->setName($name);
            $recipeType->setDescription($description);
            $this->entityManager->persist($recipeType);
        }

        $nutrientTypes = [
            ['Protein', 'g'],
            ['Carbohydrates', 'g'],
            ['Fat', 'g'],
            ['Fiber', 'g'],
            ['Sugar', 'g'],
            ['Sodium', 'mg'],
            ['Calcium', 'mg'],
            ['Iron', 'mg'],
            ['Vitamin C', 'mg'],
            ['Calories', 'kcal'],
        ];

        foreach ($nutrientTypes as [$name, $unit]) {
            $nutrientType = new NutrientType();
            $nutrientType->setName($name);
            $nutrientType->setUnit($unit);
            $this->entityManager->persist($nutrientType);
        }

        $this->entityManager->flush();

        $io->success('Mock data loaded successfully.');

        return Command::SUCCESS;
    }
}
