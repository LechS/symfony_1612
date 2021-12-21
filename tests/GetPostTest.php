<?php
declare(strict_types=1);

namespace App\Tests;

use App\Entity\Post;
use App\Service\Dto\GetPostUseCase;
use App\Service\Dto\PostOutputDto;
use App\Tests\Doubles\MockPostRepository;
use PHPUnit\Framework\TestCase;

final class GetPostTest extends TestCase
{
	private const POST_ID = 1;

	public function test(): void
	{
		//przyotowanie środowiska -> można w funkcjach given..()
		$repository = new MockPostRepository();
		$post = (new Post())
			->setId(self::POST_ID)
			->setTitle('title')
			->setContent('content')
			->setAuthor('author');

		$repository->store($post);

		$useCase = new GetPostUseCase(
			$repository
		);
		//wykonanie -> funkcja when..()
		$dto = $useCase->__invoke((string) self::POST_ID);

		//sprawdzanie -> then ..()
		self::assertInstanceOf(PostOutputDto::class, $dto);
		self::assertEquals(self::POST_ID, $dto->getId());
	}
}
