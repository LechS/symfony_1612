<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
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
		$qb = $this
			->createQueryBuilder('p')
			->andWhere('p.deletedAt IS NULL')
			->orderBy('p.createdAt', 'DESC');

		return $qb->getQuery();
	}

	public function store(Post $post) {
		$post->setUpdatedAt(new \DateTimeImmutable());
		$this->_em->persist($post);
		$this->_em->flush();
	}
}
