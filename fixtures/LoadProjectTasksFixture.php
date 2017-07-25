<?php

declare(strict_types=1);

namespace Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Ramsey\Uuid\Uuid;
use Todora\Domain\Project;
use Todora\Domain\Task;

class LoadProjectTasksFixture extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var int
     */
    private $tasksCount;

    public function __construct(int $tasksCount = 6)
    {
        $this->tasksCount = $tasksCount;
    }

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("pl_PL");

        $projects = $manager->getRepository(Project::class)
            ->findAll();

        foreach ($projects as $project) {
            for ($i = 0; $i < $this->tasksCount; $i++) {
                $task = Task::create(
                    Uuid::uuid4(),
                    new Task\Description($faker->words(3, true)),
                    $project
                );

                $manager->persist($task);
            }
        }

        $manager->flush();
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return 20;
    }
}
