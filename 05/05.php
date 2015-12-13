<?php
$input = file_get_contents('input.txt');
$strings = explode("\n", $input);

function twoInARow($string)
{
	$length = strlen($string);

    for($i = 0; $i < $length; $i++)
    {
        if(isset($string[$i + 1]) && $string[$i] == $string[$i + 1])
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