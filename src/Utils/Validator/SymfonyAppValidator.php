<?php
declare(strict_types=1);


namespace App\Utils\Validator;


use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SymfonyAppValidator implements AppValidatorInterface
{
	public function __construct(
		private ValidatorInterface $validator
	)
	{}

	public function validate($data): void
	{
		$errors = $this->validator->validate($data);

		if (count($errors) > 0) {

			$errorsString = (string) $errors;

			throw new ValidationException($errorsString);
		}
	}

}
