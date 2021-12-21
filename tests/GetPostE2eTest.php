<?php
declare(strict_types=1);

namespace App\Tests;

use App\Entity\Post;
use App\Repository\DoctrinePostRepository;
use App\Repository\PostRepositoryInterface;
use App\Tests\Doubles\MockPostRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetPostE2eTest extends WebTestCase
{
	private $client;
	private PostRepositoryInterface $repository;
	private $postId;

	protected function setUp(): void
	{
		$this->client = self::createClient();

		$container = self::getContainer();

		$container->set(PostRepositoryInterface::class, new MockPostRepository());
		$this->repository = self::getContainer()->get(PostRepositoryInterface::class);
	}

	public function test()
	{
		$post = (new Post())
			->setId(1)
			->setTitle('title')
			->setContent('content')
			->setAuthor('author');

		$this->repository->store($post);
		$this->postId = $post->getId();

		$this->client->request(
			'GET',
			'/api/post/'.$this->postId,
			[],
			[],
			['CONTENT_TYPE' => 'application-json'],
		);


		$response = $this->client->getResponse();

		self::assertEquals(200, $response->getStatusCode());

	}
}
