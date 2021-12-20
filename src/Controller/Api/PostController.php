<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/post')]
final class PostController
{
	#[Route('/{id}', name: 'api_post_show', methods: ['GET'])]
	public function show(Post $post, SerializerInterface $serializer): JsonResponse
	{
		$post = $serializer->serialize($post);
		return new JsonResponse(data: $post, json: true);
	}
}
