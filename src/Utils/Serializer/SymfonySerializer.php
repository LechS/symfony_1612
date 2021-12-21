<?php
declare(strict_types=1);


namespace App\Utils\Serializer;

use Symfony\Component\Serializer\SerializerInterface as VendorSymfonySerializer;

final class SymfonySerializer implements SerializerInterface
{
	public function __construct(
		 private VendorSymfonySerializer $vendorSerializer
	){}

	public function serialize($data, string $format, array $context = [])
	{
		return $this->vendorSerializer->serialize($data, $format, $context);
	}

	public function deserialize($data, string $type, string $format, array $context = [])
	{


		return $this->vendorSerializer->deserialize($data, $type, $format, $context);
	}
}
