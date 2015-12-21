<?php
$input = file_get_contents('input.txt');
$cookies = [];

foreach(explode("\n", $input) as $cookie)
{
	$parts = explode(' ', str_replace(',', '', $cookie));

	$cookies[] = new Cookie($parts[0], $parts[2], $parts[4], $parts[6], $parts[8], $parts[10]);
}

class Cookie
{
	private $name, $capacity, $durability, $flavor, $texture, $calories;

	public function __construct($name, $capacity, $durability, $flavor, $texture, $calories)
	{
		$this->name = $name;
		$this->capacity = $capacity;
		$this->durability = $durability;
		$this->flavor = $flavor;
		$this->texture = $texture;
		$this->calories = $calories;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getCapacity()
	{
		return $this->capacity;
	}

	public function getDurability()
	{
		return $this->durability;
	}

	public function getFlavor()
	{
		return $this->flavor;
	}

	public function getTexture()
	{
		return $this->texture;
	}

	public function getCalories()
	{
		return $this->calories;
	}
}

$highestScore = 0;

for($a = 0; $a <= 100; $a++)
{
	for($b = 0; $b <= 100; $b++)
	{
		for($c = 0; $c <= 100; $c++)
		{
			for($d = 0; $d <= 100; $d++)
			{
				if($a + $b + $c + $d !== 100)
				{
					continue;
				}

				$capacity = max(0, $a * $cookies[0]->getCapacity() + $b * $cookies[1]->getCapacity() + $c * $cookies[2]->getCapacity() + $d * $cookies[3]->getCapacity());
				$durability = max(0, $a * $cookies[0]->getDurability() + $b * $cookies[1]->getDurability() + $c * $cookies[2]->getDurability() + $d * $cookies[3]->getDurability());
				$flavor = max(0, $a * $cookies[0]->getFlavor() + $b * $cookies[1]->getFlavor() + $c * $cookies[2]->getFlavor() + $d * $cookies[3]->getFlavor());
				$texture = max(0, $a * $cookies[0]->getTexture() + $b * $cookies[1]->getTexture() + $c * $cookies[2]->getTexture() + $d * $cookies[3]->getTexture());

				$score = $capacity * $durability * $flavor * $texture;

				if($score > $highestScore)
				{
					$highestScore = $score;
				}
			}
		}
	}
}

echo 'The highest score is ' . $highestScore . PHP_EOL;

$highestScore = 0;
$calories = 500;

for($a = 0; $a <= 100; $a++)
{
	for($b = 0; $b <= 100; $b++)
	{
		for($c = 0; $c <= 100; $c++)
		{
			for($d = 0; $d <= 100; $d++)
			{
				if($a + $b + $c + $d !== 100 || ($a * $cookies[0]->getCalories() + $b * $cookies[1]->getCalories() + $c * $cookies[2]->getCalories() + $d * $cookies[3]->getCalories()) !== 500)
				{
					continue;
				}

				$capacity = max(0, $a * $cookies[0]->getCapacity() + $b * $cookies[1]->getCapacity() + $c * $cookies[2]->getCapacity() + $d * $cookies[3]->getCapacity());
				$durability = max(0, $a * $cookies[0]->getDurability() + $b * $cookies[1]->getDurability() + $c * $cookies[2]->getDurability() + $d * $cookies[3]->getDurability());
				$flavor = max(0, $a * $cookies[0]->getFlavor() + $b * $cookies[1]->getFlavor() + $c * $cookies[2]->getFlavor() + $d * $cookies[3]->getFlavor());
				$texture = max(0, $a * $cookies[0]->getTexture() + $b * $cookies[1]->getTexture() + $c * $cookies[2]->getTexture() + $d * $cookies[3]->getTexture());

				$score = $capacity * $durability * $flavor * $texture;

				if($score > $highestScore)
				{
					$highestScore = $score;
				}
			}
		}
	}
}

echo 'The highest score with exactly ' . $calories . ' calories is ' . $highestScore . PHP_EOL;