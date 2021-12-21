<?php
declare(strict_types=1);


namespace App\Tests;


use App\Entity\Post;
use App\Repository\DoctrinePostRepository;
use App\Repository\PostRepositoryInterface;
use App\Service\Dto\GetPostUseCase;
use App\Service\Dto\PostOutputDto;
use App\Tests\Doubles\MockPostRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class GetPostKernelTest extends KernelTestCase
{

	private DoctrinePostRepository $repository;

	private $postId;

	public function setUp(): void
	{
		$this->repository = self::getContainer()->get(PostRepositoryInterface::class);
	}

	public function test(): void
	{
		//przygotowanie środowiska -> można w funkcjach given..()
		$post = (new Post())
			->setTitle('title')
			->setContent('content')
			->setAuthor('author');

		$this->repository->store($post);
		$this->postId = $post->getId();

		$useCase = new GetPostUseCase(
			$this->repository
		);
		//wykonanie -> funkcja when..()
		$dto = $useCase->__invoke((string) $post->getId());

		//sprawdzanie -> then ..()
		self::assertInstanceOf(PostOutputDto::class, $dto);
		self::assertEquals($this->postId, $dto->getId());
	}
}
