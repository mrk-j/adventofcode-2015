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