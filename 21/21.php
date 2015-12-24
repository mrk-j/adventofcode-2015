<?php
$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

foreach($lines as $line)
{
	$parts = explode(': ', $line);

	if($parts[0] === 'Hit Points')
	{
		$bossHitPoints = (int) $parts[1];
	}
	elseif($parts[0] === 'Damage')
	{
		$bossDamage = (int) $parts[1];
	}
	elseif($parts[0] === 'Armor')
	{
		$bossArmor = (int) $parts[1];
	}
}

class Item
{
	private $name, $cost, $damage, $armor;

	public function __construct($name, $cost, $damage, $armor)
	{
		$this->name = $name;
		$this->cost = $cost;
		$this->damage = $damage;
		$this->armor = $armor;
	}

	public function getCost()
	{
		return $this->cost;
	}

	public function getDamage()
	{
		return $this->damage;
	}

	public function getArmor()
	{
		return $this->armor;
	}
}

class Weapon extends Item { }
class Armor extends Item { }
class Ring extends Item { }

$weapons = [
	new Weapon('Dagger', 8, 4, 0),
	new Weapon('Shortsword', 10, 5, 0),
	new Weapon('Warhammer', 25, 6, 0),
	new Weapon('Longsword', 40, 7, 0),
	new Weapon('Greataxe', 74, 8, 0),
];

$armors = [
	new Armor('Leather', 13, 0, 1),
	new Armor('Chainmail', 31, 0, 2),
	new Armor('Splintmail', 53, 0, 3),
	new Armor('Bandedmail', 75, 0, 4),
	new Armor('Platemail', 102, 0, 5),
];

$rings = [
	new Ring('Damage +1', 25, 1, 0),
	new Ring('Damage +2', 50, 2, 0),
	new Ring('Damage +3', 100, 3, 0),
	new Ring('Defense +1', 20, 0, 1),
	new Ring('Defense +2', 40, 0, 2),
	new Ring('Defense +3', 80, 0, 3),
];

$combinations = [];

foreach($weapons as $weapon)
{
	foreach($armors as $armor)
	{
		foreach($rings as $ringOne)
		{
			foreach($rings as $ringTwo)
			{
				if($ringOne !== $ringTwo)
				{
					$combinations[] = [$weapon, $armor, $ringOne, $ringTwo]; // Weapon, armor and two rings
				}
			}
		}

		foreach($rings as $ring)
		{
			$combinations[] = [$weapon, $armor, $ring]; // Weapon, armor and one ring
		}
	}

	foreach($rings as $ringOne)
	{
		foreach($rings as $ringTwo)
		{
			if($ringOne !== $ringTwo)
			{
				$combinations[] = [$weapon, $ringOne, $ringTwo]; // Weapon, no armor and two rings
			}
		}
	}

	foreach($rings as $ring)
	{
		$combinations[] = [$weapon, $ring]; // Weapon, no armor and one ring
	}
}

echo 'There are ' . count($combinations) . ' combinations possible' . PHP_EOL;

function getDamage($combination)
{
	$damage = 0;

	foreach($combination as $item)
	{
		$damage += $item->getDamage();
	}

	return $damage;
}

function getArmor($combination)
{
	$armor = 0;

	foreach($combination as $item)
	{
		$armor += $item->getArmor();
	}

	return $armor;
}

function getCost($combination)
{
	$cost = 0;

	foreach($combination as $item)
	{
		$cost += $item->getCost();
	}

	return $cost;
}

function willPlayerWin($playerHitPoints, $playerDamage, $playerArmor, $bossHitPoints, $bossDamage, $bossArmor)
{
	while($playerHitPoints > 0 && $bossHitPoints > 0)
	{
		// Player hits boss
		$bossHitPoints -= max(1, ($playerDamage - $bossArmor));

		if($bossHitPoints <= 0)
		{
			return true;
		}

		// Boss hits player
		$playerHitPoints -= max(1, ($bossDamage - $playerArmor));

		if($playerHitPoints <= 0)
		{
			return false;
		}
	}
}

$minGold = false;
$maxGold = false;
$hitpoints = 100;

foreach($combinations as $combination)
{
	$cost = getCost($combination);

	$damage = getDamage($combination);
	$armor = getArmor($combination);

	if(willPlayerWin($hitpoints, $damage, $armor, $bossHitPoints, $bossDamage, $bossArmor))
	{
		if(!$minGold || $cost < $minGold)
		{
			$minGold = $cost;
		}
	}
	elseif(!$maxGold || $cost > $maxGold)
	{
		$maxGold = $cost;
	}
}

echo 'The least amount of gold is ' . $minGold . PHP_EOL;
echo 'You can spend ' . $maxGold . ' gold and still lose' . PHP_EOL;