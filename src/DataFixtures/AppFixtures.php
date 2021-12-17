<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
	public function load(ObjectManager $manager): void
    {
		$faker = Factory::create();

		$batchSize = 20;

		for($i = 0; $i < 1000; $i++) {

			$date = $faker->dateTime;

			$post = new Post();
			$post
				->setTitle($faker->realText(100))
				->setContent($faker->realText())
				->setAuthor($faker->name)
				->setCreatedAt(new \DateTimeImmutable($date->format('c')))
				->setUpdatedAt(new \DateTimeImmutable($date->format('c')));

			$manager->persist($post);
			if (($i % $batchSize) === 0) {
				$manager->flush();
				$manager->clear();
			}
		}
        $manager->flush();
    }
}
