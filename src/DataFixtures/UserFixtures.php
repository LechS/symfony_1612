<?php
declare(strict_types=1);


namespace App\DataFixtures;

use App\Service\Dto\UserDto;
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
		//używanie Serwisu z całym usecasme w FIXTURE nie jest najlepszeym pomysłem
		//gdyż service moze mieć efekty uboczne, które nie powinny miec miejsca przy ładowaniu fixtures
		// to jest tylko przykład reużywalności serwisu :)

		$userDto = (new UserDto())
			->setEmail('test@example.com')
			->setPlainPassword('haslo');

		$this->useCase->__invoke($userDto);
	}

}
