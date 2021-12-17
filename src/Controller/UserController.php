<?php
declare(strict_types=1);


namespace App\Controller;


use App\Service\UserRegisterUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
final class UserController extends AbstractController
{
	#[Route('/register', name: 'user_register', methods: ['GET', 'POST'])]
	public function register(UserRegisterUseCase $userRegister): Response
	{
		$userRegister();
		return new Response();
	}
}
