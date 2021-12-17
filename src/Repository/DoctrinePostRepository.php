<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

class DoctrinePostRepository implements PostRepositoryInterface
{
	private ObjectManager $manager;
	private ObjectRepository $repository;

    public function __construct(ManagerRegistry $registry)
    {
        $this->manager = $registry->getManagerForClass(Post::class);
		$this->repository = $this->manager->getRepository(Post::class);
    }

	/**
	 * @inheritDoc
	 */
	public function findAll()
	{
		$query = $this->getFindAllQuery();

		return $query->getResult();
	}

	/**
	 * @return \Doctrine\ORM\Query
	 */
	public function getFindAllQuery(): \Doctrine\ORM\Query
	{
		$qb = $this->repository
			->createQueryBuilder('p')
			->andWhere('p.deletedAt IS NULL')
			->orderBy('p.createdAt', 'DESC');

		return $qb->getQuery();
	}

	public function store(Post $post) {
		$post->setUpdatedAt(new \DateTimeImmutable());
		$this->manager->persist($post);
		$this->manager->flush();
	}
}
