<?php
declare(strict_types=1);


namespace App\Service\Dto;


use App\Repository\PostRepositoryInterface;

final class GetPostUseCase
{
	public function __construct(
		private PostRepositoryInterface $repository
	){}

	public function __invoke(string $id): PostOutputDto
	{
		$post = $this->repository->findOneBy($id);

		return new PostOutputDto(
			$post->getId(),
			$post->getTitle(),
			$post->getContent(),
			$post->getCreatedAt()->format('c'),
			$post->getAuthor()
		);
	}
}
