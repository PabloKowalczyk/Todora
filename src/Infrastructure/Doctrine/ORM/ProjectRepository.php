<?php

declare(strict_types=1);

namespace Todora\Infrastructure\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Ramsey\Uuid\UuidInterface;
use Todora\Domain\Project;

class ProjectRepository implements Project\ProjectRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Project $project): void
    {
        $this->entityManager
            ->persist($project);
    }

    public function getProject(UuidInterface $projectId): Project
    {
        $queryBuilder = $this->entityManager
            ->createQueryBuilder();

        $query = $queryBuilder
            ->select("p")
            ->from(Project::class, "p")
            ->where("p.id = :projectId")
            ->setParameter("projectId", $projectId)
            ->getQuery();

        return $query->getSingleResult(Query::HYDRATE_SIMPLEOBJECT);
    }
}
