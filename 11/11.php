<?php
$currentPassword = 'cqjxjnds';

function nextPassword($currentPassword)
{
	$alfabet = range('a', 'z');
	$lastCharacter = substr($currentPassword, -1);
	$incrementCount = 1;

	if($lastCharacter === 'z')
	{
		for($i = (strlen($currentPassword) - 1); $i > 0; $i--)
		{
			$character = substr($currentPassword, $i, 1);

			if($character === 'z')
			{
				$incrementCount++;
			}
			else
			{
				break;
			}
		}
	}

	if($incrementCount == strlen($currentPassword))
	{
		die('Last password reached!' . PHP_EOL);
	}

	$nextPassword = str_split($currentPassword);

	for($i = (count($nextPassword) - 1); $i >= (count($nextPassword) - $incrementCount); $i--)
	{
		$character = substr($currentPassword, $i, 1);

		if($character === 'z')
		{
			$character = 'a';
		}
		else
		{
			$character = $alfabet[array_search($character, $alfabet) + 1];
		}

		$nextPassword[$i] = $character;
	}

	return implode('', $nextPassword);
}

function twoInARowSets($string, $offset = 1)
{
	$sets = [];
	$length = strlen($string);

	for($i = 0; $i < $length; $i++)
	{
		if(isset($string[$i + $offset]) && $string[$i] == $string[$i + $offset])
		{
			$sets[] = $string[$i];
		}
	}

	return count(array_unique($sets));
}

$possibleStraights = [];
$alfabet = range('a', 'z');
$length = 3;

for($i = 0; $i < count($alfabet); $i++)
{
	if(isset($alfabet[$i + ($length - 1)]))
	{
		$straight = implode('', array_slice($alfabet, $i, $length));

		$possibleStraights[] = $straight;
	}
}

function hasStraight($string)
{
	global $possibleStraights;

	foreach($possibleStraights as $possibleStraight)
	{
		if(strpos($string, $possibleStraight) !== false)
		{
			return true;
		}
	}

	return false;
}

function isValidPassword($password)
{
	if(strpos($password, 'i') !== false || strpos($password, 'o') !== false || strpos($password, 'l') !== false)
	{
		return false;
	}
	elseif(twoInARowSets($password) < 2)
	{
		return false;
	}
	elseif(!hasStraight($password))
	{
		return false;
	}

	return true;
}

do
{
	$newPassword = nextPassword(isset($newPassword) ? $newPassword : $currentPassword);
}
while(!isValidPassword($newPassword));

echo 'Found new password: ' . $newPassword . PHP_EOL;

do
{
	$newPassword = nextPassword(isset($newPassword) ? $newPassword : $currentPassword);
}
while(!isValidPassword($newPassword));

echo 'Found next new password: ' . $newPassword . PHP_EOL;