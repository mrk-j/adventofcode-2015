<?php
$input = file_get_contents('input.txt');
$strings = explode("\n", $input);

function twoInARow($string, $offset = 1)
{
	$length = strlen($string);

	for($i = 0; $i < $length; $i++)
	{
		if(isset($string[$i + $offset]) && $string[$i] == $string[$i + $offset])
		{
			return true;
		}
	}

	return false;
}

function isStringNice($string)
{
	if(str_replace(['ab', 'cd', 'pq', 'xy'], '', $string) !== $string)
	{
		return 0;
	}
	elseif(strlen($string) - strlen(str_replace(['a', 'e', 'u', 'i', 'o'], '', $string)) < 3)
	{
		return 0;
	}
	elseif(!twoInARow($string))
	{
		return 0;
	}

	return 1;
}

$result = array_map("isStringNice", $strings);

echo 'There are ' . array_count_values($result)[1] . ' nice strings' . PHP_EOL;

function doublePair($string)
{
	$length = strlen($string);

	for($i = 0; $i < $length; $i++)
	{
		if($i + 1 < $length)
		{
			$pair = substr($string, $i, 2);
			$remainder = substr($string, 0, $i) . ' ' . substr($string, $i + 2);

			if(strpos($remainder, $pair) !== false)
			{
				return true;
			}
		}
	}

	return false;
}

function isStringNiceTwo($string)
{
	if(doublePair($string) && twoInARow($string, 2))
	{
		return 1;
	}

	return 0;
}

$result = array_map("isStringNiceTwo", $strings);

echo 'There are ' . array_count_values($result)[1] . ' nice strings' . PHP_EOL;