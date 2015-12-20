<?php
$input = file_get_contents('input.txt');
$object = (array) json_decode($input);

function getSum($array)
{
	$sum = 0;

	foreach($array as $item)
	{
		if(is_int($item))
		{
			$sum += $item;
		}
		elseif(is_object($item))
		{
			$sum += getSum((array) $item);
		}
		elseif(is_array($item))
		{
			$sum += getSum($item);
		}
	}

	return $sum;
}

$array = (array) json_decode($input);
echo 'The sum of all numbers is ' . getSum($array) . PHP_EOL;

function getSumWithoutRed($array)
{
	$sum = 0;

	if(is_object($array))
	{
		foreach($array as $item)
		{
			if($item === 'red')
			{
				return 0;
			}
		}
	}

	foreach($array as $item)
	{
		if(is_int($item))
		{
			$sum += $item;
		}		
		elseif(is_array($item))
		{
			$sum += getSumWithoutRed($item);
		}
		elseif(is_object($item))
		{
			$sum += getSumWithoutRed($item);
		}
	}

	return $sum;
}

$object = json_decode($input);

echo 'The sum of all numbers without red is ' . getSumWithoutRed($object) . PHP_EOL;
?>