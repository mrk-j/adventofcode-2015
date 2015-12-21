<?php
ini_set('memory_limit', '2048M');

$input = file_get_contents('input.txt');
$containers = array_map(function($value) { return (int) $value; }, explode("\n", $input));

function getContainerCombinations($containers)
{
	$combinations = [[]];

	foreach($containers as $container)
	{
		foreach($combinations as $combination)
		{
			$combinations[] = array_merge([$container], $combination);
		}
	}

	return $combinations;
}

$minContainerCount = false;
$minContainers = 0;
$numberOfCombinations = 0;

foreach(getContainerCombinations($containers) as $combination)
{
	if(array_sum($combination) === 150)
	{
		$numberOfCombinations++;

		if($minContainers === count($combination))
		{
			$minContainerCount++;
		}
		elseif(!$minContainerCount || $minContainers > count($combination))
		{
			$minContainerCount = 1;
			$minContainers = count($combination);
		}
	}
}

echo 'The number of combinations is ' . $numberOfCombinations . PHP_EOL;
echo 'The minimal number of containers is ' . $minContainers . ' and can be made with ' . $minContainerCount . ' combinations' . PHP_EOL;