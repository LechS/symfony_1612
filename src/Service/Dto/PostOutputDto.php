<?php
declare(strict_types=1);


namespace App\Service\Dto;


final class PostOutputDto
{
	private int $id;

	private string $title;

	private string $content;

	private string $createdAt;

	private string $author;

	public function __construct(int $id, string $title, string $content, string $createdAt, string $author)
	{
		$this->id = $id;
		$this->title = $title;
		$this->content = $content;
		$this->createdAt = $createdAt;
		$this->author = $author;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getContent(): string
	{
		return $this->content;
	}

	public function getCreatedAt(): string
	{
		return $this->createdAt;
	}

	public function getAuthor(): string
	{
		return $this->author;
	}
}
