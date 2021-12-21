<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/post')]
final class PostController
{
	#[Route('/{id}', name: 'api_post_show', methods: ['GET'])]
	public function show(Post $post, SerializerInterface $serializer): JsonResponse
	{
		$post = $serializer->serialize($post, 'json');
		return new JsonResponse(data: $post, json: true);
	}



	#[Route('', name: 'api_post_new', methods: ['POST'])]
	public function new(Request $request): JsonResponse
	{
		dd($request->getContent());

		return new JsonResponse([], 200);
	}

// @TODO list posts in api
//	#[Route('/', name: 'api_post_show', methods: ['GET'])]
//	public function index(Post $post, SerializerInterface $serializer): JsonResponse
//	{
//		$post = $serializer->serialize($post, 'json');
//		return new JsonResponse(data: $post, json: true);
//	}
}
