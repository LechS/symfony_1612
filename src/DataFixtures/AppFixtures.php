<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		$batchSize = 20;

		for($i = 0; $i < 1000; $i++) {
			$post = new Post();
			$post
				->setTitle('title')
				->setContent('content')
				->setAuthor('autor')
				->setCreatedAt(new \DateTimeImmutable())
				->setUpdatedAt(new \DateTimeImmutable());

			$manager->persist($post);
			if (($i % $batchSize) === 0) {
				$manager->flush();
				$manager->clear();
			}
		}
        $manager->flush();
    }
}
