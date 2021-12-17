<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\ORM\OptimisticLockException;

interface PostRepositoryInterface
{

	public function findAll();

	/* interface zwraca Query z doctrine, no trudno :) potrzebujemy go do paginatora,
	w takiej sytuacji paginację nalżałoby zrobić inaczej */
	public function getFindAllQuery(): \Doctrine\ORM\Query;

	public function store(Post $post);
}
