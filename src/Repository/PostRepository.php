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
		$qb = $this
			->createQueryBuilder('p')
			->andWhere('p.deletedAt IS NULL')
			->orderBy('p.createdAt', 'DESC');

		$query = $qb->getQuery();

		return $query->getResult();


	}

	/**
	 * @inheritDoc
	 * HOW TO USE RAW SQL in repository
	 */
//	public function findAll()
//	{
//
//		$sql = 'SELECT * FROM post WHERE deleted_at IS NULL ORDER BY created_at DESC';
//
//		$conn =  $this->getEntityManager()->getConnection();
//
//		$stmt = $conn->prepare($sql);
//
//		dd($stmt->executeQuery()->fetchAllAssociative());
//
//	}

    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
