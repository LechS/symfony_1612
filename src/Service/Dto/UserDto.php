<?php
declare(strict_types=1);


namespace App\Service\Dto;


use Symfony\Component\Validator\Constraints as Assert;

final class UserDto
{
	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3)
	 * @Assert\Email()
	 */
	private string $email;

	/**
	 * @Assert\Length(min=5)
	 * mozemy zrobic wlasny assert do hasła
	 */
	private string $plainPassword;


	public function getEmail(): string
	{
		return $this->email;
	}


	public function getPlainPassword(): string
	{
		return $this->plainPassword;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @param string $plainPassword
	 */
	public function setPlainPassword(string $plainPassword): void
	{
		$this->plainPassword = $plainPassword;
	}


}
