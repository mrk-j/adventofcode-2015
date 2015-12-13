<?php
$input = 'yzbqklnj';
$hashFound = false;
$i = 1;

while(!$hashFound)
{
	$hash = md5($input . $i);

	if(substr($hash, 0, 5) === '00000')
	{
		$hashFound = true;
	}
	else
	{
		$i++;
	}
}

echo 'Hash (' . $hash . ') found at number ' . $i . PHP_EOL;