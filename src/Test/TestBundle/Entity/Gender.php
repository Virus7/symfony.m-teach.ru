<?php
namespace Test\TestBundle\Entity;

class Gender
{
	public static function getTypes()
	{
		return ['М', 'Ж'];
	}

	public static function getTypeValues()
	{
		return array_keys(self::getTypes());
	}
}