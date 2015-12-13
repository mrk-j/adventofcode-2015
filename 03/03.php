<?php
$input = file_get_contents('input.txt');
$map = [
	[0, 0]
];

//Moves are always exactly one house to the north (^), south (v), east (>), or west (<).

for($i = 0; $i < strlen($input); $i++)
{
	$direction = $input{$i};

	switch($direction)
	{
		case '^':
			$map[] = [$map[$i][0] + 1, $map[$i][1]];
			break;
		case 'v':
			$map[] = [$map[$i][0] - 1, $map[$i][1]];
			break;
		case '>':
			$map[] = [$map[$i][0], $map[$i][1] + 1];
			break;
		case '<':
			$map[] = [$map[$i][0], $map[$i][1] - 1];
			break;
	}
}

echo 'Santa was at ' . count(array_unique($map, SORT_REGULAR)) . ' houses' . PHP_EOL;

$map['santa'] = [
	[0, 0]
];

$map['robo'] = [
	[0, 0]
];

for($i = 0; $i < strlen($input); $i++)
{
	$direction = $input{$i};

	$key = $i % 2 == 0 ? 'santa' : 'robo';

	$lastPosition = end($map[$key]);

	switch($direction)
	{
		case '^':
			$map[$key][$i] = [$lastPosition[0] + 1, $lastPosition[1]];
			break;
		case 'v':
			$map[$key][$i] = [$lastPosition[0] - 1, $lastPosition[1]];
			break;
		case '>':
			$map[$key][$i] = [$lastPosition[0], $lastPosition[1] + 1];
			break;
		case '<':
			$map[$key][$i] = [$lastPosition[0], $lastPosition[1] - 1];
			break;
	}
}
echo 'Santa and RoboSanta were at ' . count(array_unique($map['santa'] + $map['robo'], SORT_REGULAR)) . ' houses' . PHP_EOL;