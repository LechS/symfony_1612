<?php
declare(strict_types=1);


namespace App\Service\Dto;


use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class NewPostDto
{
	/**
	 * @Assert\NotBlank
	 */
	private string $title;

	/**
	 * @SerializedName("tresc")
	 * @Assert\NotBlank
	 */
	private string $content;

	/**
	 * @Assert\NotBlank
	 * @Assert\Length(min=3)
	 */
	private string $author;

	public function __construct(string $title, string $content, string $author)
	{
		$this->title = $title;
		$this->content = $content;
		$this->author = $author;
	}

	public function title(): string
	{
		return $this->title;
	}

	public function content(): string
	{
		return $this->content;
	}

	public function author(): string
	{
		return $this->author;
	}
}
