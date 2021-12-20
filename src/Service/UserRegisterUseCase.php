<?php
declare(strict_types=1);


namespace App\Service;

use App\Entity\User;
use App\Service\Dto\UserDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserRegisterUseCase
{
	public function __construct(
		private UserPasswordHasherInterface $passwordHasher,
		private EntityManagerInterface $em
	){}

	public function __invoke(UserDto $userDto)
	{
		$user = new User();
		$user->setEmail($userDto->getEmail());

        $hashedPassword = $this->passwordHasher->hashPassword(
			$user,
			$userDto->getPlainPassword()
		);
        $user->setPassword($hashedPassword);
		$user->setRoles($userDto->getRoles());

		$this->em->persist($user);
		$this->em->flush();
	}

}
