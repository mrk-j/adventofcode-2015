<?php
$input = file_get_contents('input.txt');
$floor = 0;
$wasInBasement = false;

for($i = 0; $i < strlen($input); $i++)
{
	$floor += $input{$i} === '(' ? 1 : -1;

	if($floor === -1 && !$wasInBasement)
	{
		$wasInBasement = true;

		echo 'Santa is in basement after position ' . ($i + 1) . PHP_EOL;
	}
}

echo 'Santa is on floor ' . $floor . PHP_EOL;