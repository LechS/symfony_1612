<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Post;
use App\Form\PostType;
use App\Service\Dto\NewPostDto;
use App\Service\NewPostUseCase;
use App\Utils\Validator\AppValidatorInterface;
use JetBrains\PhpStorm\Pure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use App\Utils\Serializer\SerializerInterface;

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
	public function new(
		Request               $request,
		SerializerInterface   $serializer,
		AppValidatorInterface $validator,
		NewPostUseCase        $useCase
	): JsonResponse {
		$json = $request->getContent();
		$newPostDto = $serializer->deserialize(
			$json, NewPostDto::class, 'json',
			[AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false]
		);

		//Kod walidacji można umieścić we własnym "Serwisie", który będzie korzystał z Symfony Validatora
		// I ten serwis może "rzucać" własny błąd ValidationException, który będzie obsłużny w
		// Subscriberze przechwytującym błędy.

		// W subscriberze obsłużyć następujące błędy
		// - walidacja
		// - serializacja, jeśli za dużo póli i za mało pólu w jsonie
		$validator->validate($newPostDto);


		$useCase($newPostDto);

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
