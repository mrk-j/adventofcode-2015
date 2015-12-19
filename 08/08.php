<?php
$input = file_get_contents('input.txt');
$strings = explode("\n", $input);

$charactersOfCode = 0;
$charactersInMemory = 0;

foreach($strings as $string)
{
	$charactersOfCode += strlen($string);

	eval("\$str = " . $string . ";");

	$charactersInMemory += strlen($str);
}

echo 'Characters of code: ' . $charactersOfCode . PHP_EOL;
echo 'Characters in memory: ' . $charactersInMemory . PHP_EOL;
echo 'Difference: ' . ($charactersOfCode - $charactersInMemory) . PHP_EOL;

$charactersOfCode = 0;
$charactersInMemory = 0;

foreach($strings as $string)
{
	$string = '"' . addslashes($string) . '"';

	$charactersOfCode += strlen($string);

	eval("\$str = " . $string . ";");

	$charactersInMemory += strlen($str);
}

echo 'Characters of code: ' . $charactersOfCode . PHP_EOL;
echo 'Characters in memory: ' . $charactersInMemory . PHP_EOL;
echo 'Difference: ' . ($charactersOfCode - $charactersInMemory) . PHP_EOL;