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
			->setEmail('user@example.com')
			->setPlainPassword('haslo');


		$userAdminDto = (new UserDto())
			->setEmail('admin@example.com')
			->setPlainPassword('haslo')
			->setRoles(['ROLE_ADMIN']);

		//DODAC tworzenie uzytkownika z rolą admin
		// ustawić dostęp:
		// - user może wyświetlać
		// admin moze dodawać posty
		//2 czesc
		// user tylko wyswietla (list i show)
		//admin new, edit, delete
		// w twigu user nie widzi innych akcji niz te do których ma dostęp

		$this->useCase->__invoke($userDto);
		$this->useCase->__invoke($userAdminDto);
	}

}
