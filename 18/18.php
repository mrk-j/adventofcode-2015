<?php
$input = file_get_contents('input.txt');
$rows = explode("\n", $input);

$grid = [];

foreach($rows as $x => $row)
{
	$columns = str_split($row);

	foreach($columns as $y => $column)
	{
		$grid[$x][$y] = $column === '#' ? true : false;
	}
}

function animateGrid($grid)
{
	$animatedGrid = [];

	foreach($grid as $x => $rows)
	{
		foreach($rows as $y => $field)
		{
			$neighboursOn = 0;
			$neighboursOff = 0;

			$neighbours = [
				[-1, -1],
				[-1, 0],
				[-1, 1],
				[0, -1],
				[0, 1],
				[1, -1],
				[1, 0],
				[1, 1]
			];

			foreach($neighbours as $neighbour)
			{
				if(isset($grid[$x + $neighbour[0]][$y + $neighbour[1]]))
				{
					if($grid[$x + $neighbour[0]][$y + $neighbour[1]])
					{
						$neighboursOn++;
					}
					else
					{
						$neighboursOff--;
					}
				}
			}

			$newState = true;

			if($field)
			{
				if($neighboursOn !== 2 && $neighboursOn !== 3)
				{
					$newState = false;
				}
			}
			else
			{
				if($neighboursOn !== 3)
				{
					$newState = false;
				}
			}

			$animatedGrid[$x][$y] = $newState;
		}
	}

	return $animatedGrid;
}

function printGrid($grid)
{
	foreach($grid as $rows)
	{
		foreach($rows as $field)
		{
			echo $field ? '#' : '.';
		}

		echo PHP_EOL;
	}
}

function getNumberOfLightsOn($grid)
{
	$numberOfLightsOn = 0;

	foreach($grid as $rows)
	{
		foreach($rows as $field)
		{
			if($field)
			{
				$numberOfLightsOn++;
			}
		}
	}

	return $numberOfLightsOn;
}

function turnOnCorners($grid)
{
	$size = count($grid[0]) - 1;

	$grid[0][0] = true;
	$grid[0][$size] = true;
	$grid[$size][0] = true;
	$grid[$size][$size] = true;

	return $grid;
}

for($i = 1; $i <= 100; $i++)
{
	$grid = animateGrid($grid);
	//printGrid($grid);
}

echo 'Number of lights on is ' . getNumberOfLightsOn($grid) . PHP_EOL;

$grid = [];

foreach($rows as $x => $row)
{
	$columns = str_split($row);

	foreach($columns as $y => $column)
	{
		$grid[$x][$y] = $column === '#' ? true : false;
	}
}

$grid = turnOnCorners($grid);

for($i = 1; $i <= 100; $i++)
{
	$grid = animateGrid($grid);
	$grid = turnOnCorners($grid);
}

echo 'Number of lights on is ' . getNumberOfLightsOn($grid) . ' (stuck corners)' . PHP_EOL;