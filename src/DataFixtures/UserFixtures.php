<?php
declare(strict_types=1);


namespace App\DataFixtures;

use App\Service\UserRegisterUseCase;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends Fixture
{
	public function __construct(
		private UserRegisterUseCase $useCase
	){}

	public function load(ObjectManager $manager): void
	{
		$this->useCase->__invoke(
			'test@example.com',
			'haslo'
		);
	}

}
