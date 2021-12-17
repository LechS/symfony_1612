<?php
declare(strict_types=1);


namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserRegisterUseCase
{
	public function __construct(
		private UserPasswordHasherInterface $passwordHasher,
		private EntityManagerInterface $em
	){}

	public function __invoke(string $email, string $plaintextPassword)
	{
		$user = new User();
		$user->setEmail($email);

        $hashedPassword = $this->passwordHasher->hashPassword(
			$user,
			$plaintextPassword
		);
        $user->setPassword($hashedPassword);

		$this->em->persist($user);
		$this->em->flush();
	}

}
