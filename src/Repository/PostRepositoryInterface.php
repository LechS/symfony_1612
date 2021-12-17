<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\ORM\OptimisticLockException;

interface PostRepositoryInterface
{

	public function findAll();

	/* interface zwraca Quer z doctrine, not trudno :) potrzebujem go do paginator */
	public function getFindAllQuery(): \Doctrine\ORM\Query;

	public function store(Post $post);
}
