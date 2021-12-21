<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\Dto\NewPostDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/post')]
final class PostController extends AbstractController
{
	#[Route('/{id}', name: 'api_post_show', methods: ['GET'])]
	public function show(Post $post, SerializerInterface $serializer): JsonResponse
	{
		$post = $serializer->serialize($post, 'json');
		return new JsonResponse(data: $post, json: true);
	}

	#[Route('', name: 'api_post_new', methods: ['POST'])]
	public function new(Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
	{
		$json = $request->getContent();
		$newPostDto = $serializer->deserialize($json, NewPostDto::class, 'json');

		//Kod walidacji można umieścić we własnym "Serwisie", który będzie korzystał z Symfony Validatora
		// I ten serwis może "rzucać" własny błąd ValidationException, który będzie obsłużny w
		// Subscriberze przechwytującym błędy.
		$errors = $validator->validate($newPostDto);
		if (count($errors) > 0) {
			$errorsString = (string) $errors;
			return new JsonResponse($errorsString);
		}

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
