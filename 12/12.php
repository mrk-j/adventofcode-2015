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

echo 'The sum of all numbers is ' . getSum($object) . PHP_EOL;
?>