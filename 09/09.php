<?php
$input = file_get_contents('input.txt');
$strings = explode("\n", $input);

$distances = [];
$destinations = [];

foreach($strings as $string)
{
	$parts = explode(' = ', $string);
	$locations = explode(' to ', $parts[0]);

	$distances[$locations[0]][$locations[1]] = (int) $parts[1];

	if(!in_array($locations[0], $destinations))
	{
		$destinations[] = $locations[0];
	}

	if(!in_array($locations[1], $destinations))
	{
		$destinations[] = $locations[1];
	}
}

$routes = pc_permute($destinations);

echo 'Number of possible routes: ' . count($routes) . PHP_EOL;

$routeDistances = [];

foreach($routes as $route)
{
	$distance = 0;

	for($i = 0; $i < count($route) - 1; $i++)
	{
		if(isset($distances[$route[$i]][$route[($i + 1)]]))
		{
			$distance += $distances[$route[$i]][$route[($i + 1)]];
		}
		elseif(isset($distances[$route[($i + 1)]][$route[$i]]))
		{
			$distance += $distances[$route[($i + 1)]][$route[$i]];
		}
	}

	$routeDistances[] = $distance;
}

echo 'Minimal distance is ' . min($routeDistances) . PHP_EOL;
echo 'Largest distance is ' . max($routeDistances) . PHP_EOL;

// Copied from SO: http://stackoverflow.com/questions/5506888/permutations-all-possible-sets-of-numbers
function pc_permute($items, $perms = array( )) {
    if (empty($items)) {
        $return = array($perms);
    }  else {
        $return = array();
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
         list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             $return = array_merge($return, pc_permute($newitems, $newperms));
         }
    }
    return $return;
}