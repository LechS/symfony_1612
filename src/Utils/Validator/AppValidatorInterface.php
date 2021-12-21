<?php
declare(strict_types=1);


namespace App\Utils\Validator;

use Symfony\Component\Validator\Validator\ValidatorInterface as VendorSymfonyValidatorInterface;

interface AppValidatorInterface
{
	public function validate($data): void;

}
