<?php

declare(strict_types=1);

namespace Todora\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Ramsey\Uuid\Uuid;
use Todora\Domain\Project;

class LoadProjectsFixture extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var int
     */
    private $projectsCount;

    /**
     * LoadProjectsFixture constructor.
     */
    public function __construct(int $projectsCount = 6)
    {
        $this->projectsCount = $projectsCount;
    }

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("pl_PL");

        for ($i = 0; $i < $this->projectsCount; $i++) {
            $project = Project::create(Uuid::uuid4(), $faker->company);

            $manager->persist($project);
        }

        $manager->flush();
    }

    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return 10;
    }
}
