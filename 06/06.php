<?php
ini_set('memory_limit', '1024M');

$input = file_get_contents('input.txt');
$instructions = explode("\n", $input);

// Build grid
$grid = [];

for($x = 0; $x <= 999; $x++)
{
	for($y = 0; $y <= 999; $y++)
	{
		$grid[$x][$y] = 0;
	}
}

$brightness = $grid;

// Instructions
foreach($instructions as $instruction)
{
	if(substr($instruction, 0, 7) === 'turn on')
	{
		$action = 'turn on';
		$bulbs = substr($instruction, 8);
	}
	elseif(substr($instruction, 0, 8) === 'turn off')
	{
		$action = 'turn off';
		$bulbs = substr($instruction, 9);
	}
	elseif(substr($instruction, 0, 6) === 'toggle')
	{
		$action = 'toggle';
		$bulbs = substr($instruction, 7);
	}

	$positions = explode(" ", $bulbs);
	$firstPosition = explode(",", $positions[0]);
	$lastPosition = explode(",", $positions[2]);

	for($x = $firstPosition[0]; $x <= $lastPosition[0]; $x++)
	{
		for($y = $firstPosition[1]; $y <= $lastPosition[1]; $y++)
		{
			switch($action)
			{
				case 'turn on':
					$grid[$x][$y] = 1;
					$brightness[$x][$y]++;
					break;
				case 'turn off':
					$grid[$x][$y] = 0;
					$brightness[$x][$y] = $brightness[$x][$y] <= 1 ? 0 : ($brightness[$x][$y] - 1);
					break;
				case 'toggle':
					$grid[$x][$y] = $grid[$x][$y] === 1 ? 0 : 1;
					$brightness[$x][$y] = $brightness[$x][$y] + 2;
					break;
			}
		}
	}
}

$numberOfLitBulbs = 0;
$totalBrightness = 0;

for($x = 0; $x <= 999; $x++)
{
	for($y = 0; $y <= 999; $y++)
	{
		$numberOfLitBulbs += $grid[$x][$y] === 1 ? 1 : 0;
		$totalBrightness += $brightness[$x][$y];
	}
}

echo $numberOfLitBulbs . ' bulbs are lit' . PHP_EOL;
echo 'The total brightness is ' . $totalBrightness . PHP_EOL;