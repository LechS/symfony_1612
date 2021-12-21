<?php
declare(strict_types=1);


namespace App\Utils\Serializer;


interface SerializerInterface
{
	public function serialize($data, string $format, array $context = []);

	public function deserialize($data, string $type, string $format, array $context = []);

}
