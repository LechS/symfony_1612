<?php
declare(strict_types=1);


namespace App\Service;


use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class EditPostUseCase
{
	public function __construct(
		private PostRepository $repository
	) {}

	public function __invoke(Post $post): void
	{
		/**
		 * Tu możemy dodać potrzebną nam logikę, powiadomienia, maile itp.
		 */

		$this->repository->store($post);
	}
}
