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
		/**
		 Czy ma sens używanie encji User w Controlerze?
		 */
		$user = new User();
		$form = $this->createForm(UserType::class, $user);
		$form->handleRequest($request);


		if ($form->isSubmitted() && $form->isValid()) {
			$userRegister(
				$user->getEmail(),
				$user->getPassword()
			);
		}

		return $this->renderForm('user/new.html.twig',
			[
				'user' => $user,
				'form' => $form,
			]
		);
	}
}
