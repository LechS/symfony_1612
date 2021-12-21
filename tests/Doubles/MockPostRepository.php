<?php
declare(strict_types=1);


namespace App\Tests\Doubles;


use App\Entity\Post;
use App\Repository\PostRepositoryInterface;

final class MockPostRepository implements PostRepositoryInterface
{
	private array $posts;

	public function findOneBy(string $id): Post
	{
		return $this->posts[$id];
	}

	public function findAll()
	{
		// TODO: Implement findAll() method.
	}

	public function getFindAllQuery(): \Doctrine\ORM\Query
	{
		// TODO: Implement getFindAllQuery() method.
	}

	public function store(Post $post)
	{
		$this->posts[$post->getId()] = $post;
	}
}
