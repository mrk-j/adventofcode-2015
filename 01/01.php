<?php
$input = file_get_contents('input.txt');
$floor = 0;

for($i = 0; $i < strlen($input); $i++)
{
	$floor += $input{$i} === '(' ? 1 : -1;
}

echo 'Santa is on floor ' . $floor . PHP_EOL;