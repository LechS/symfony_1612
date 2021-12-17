<?php
declare(strict_types=1);


namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Service\UserRegisterUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
final class UserController extends AbstractController
{
	#[Route('/register', name: 'user_register', methods: ['GET', 'POST'])]
	public function register(Request $request, UserRegisterUseCase $userRegister): Response
	{
		$form = $this->createForm(UserType::class);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

			$userRegister(
				$form->getData()['email'],
				$form->getData()['plainPassword'],
			);
		}

		return $this->renderForm('user/new.html.twig',
			[
				'form' => $form,
			]
		);
	}
}
