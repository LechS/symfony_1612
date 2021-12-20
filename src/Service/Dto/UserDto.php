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

	private array $roles = [];

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
	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * @param string $plainPassword
	 */
	public function setPlainPassword(string $plainPassword): self
	{
		$this->plainPassword = $plainPassword;

		return $this;
	}

	public function getRoles(): array
	{
		return $this->roles;
	}

	public function setRoles(array $roles): UserDto
	{
		$this->roles = $roles;
		return $this;
	}
}
