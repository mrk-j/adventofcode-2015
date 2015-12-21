<?php
$input = file_get_contents('input.txt');
$sues = explode("\n", $input);

$tickerTape = [
	'children' => 3,
	'cats' => 7,
	'samoyeds' => 2,
	'pomeranians' => 3,
	'akitas' => 0,
	'vizslas' => 0,
	'goldfish' => 5,
	'trees' => 3,
	'cars' => 2,
	'perfumes' => 1,
];

$bestMatchCount = 0;
$bestMatch = '';

foreach($sues as $sue)
{
	$parts = explode(': ', $sue);

	$name = array_shift($parts);

	$values = explode(', ', implode(': ', $parts));

	$matches = 0;

	foreach($values as $temp)
	{
		list($key, $value) = explode(': ', $temp);

		foreach($tickerTape as $k => $v)
		{
			if(trim($key) == $k && trim($value) == $v)
			{
				$matches++;
			}
		}
	}

	if($matches > $bestMatchCount)
	{
		$bestMatchCount = $matches;
		$bestMatch = $name;
	}
}

echo 'The best match is ' . $bestMatch . PHP_EOL;

$bestMatchCount = 0;
$bestMatch = '';

foreach($sues as $sue)
{
	$parts = explode(': ', $sue);

	$name = array_shift($parts);

	$values = explode(', ', implode(': ', $parts));

	$matches = 0;

	foreach($values as $temp)
	{
		list($key, $value) = explode(': ', $temp);

		foreach($tickerTape as $k => $v)
		{
			if($k === 'cat' || $k === 'trees')
			{
				if(trim($key) == $k && trim($value) > $v)
				{
					$matches++;
				}
			}
			elseif($k === 'pomeranians' || $k === 'goldfish')
			{
				if(trim($key) == $k && trim($value) < $v)
				{
					$matches++;
				}
			}
			else
			{
				if(trim($key) == $k && trim($value) == $v)
				{
					$matches++;
				}
			}
		}
	}

	if($matches > $bestMatchCount)
	{
		$bestMatchCount = $matches;
		$bestMatch = $name;
	}
}

echo 'The best match after retroencabulator correction is ' . $bestMatch . PHP_EOL;