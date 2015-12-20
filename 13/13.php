<?php
ini_set('memory_limit', '1024M');

$input = file_get_contents('input.txt');
$strings = explode("\n", $input);

$guests = [];
$happiness = [];

foreach($strings as $string)
{
	$parts = explode(' ', $string);

	$personA = $parts[0];
	$personB = substr(array_pop($parts), 0, -1);

	$happiness[$personA][$personB] = $parts[3] * ($parts[2] === 'lose' ? -1 : 1);

	if(!in_array($personA, $guests))
	{
		$guests[] = $personA;
	}
}

function happinessCount($arrangement)
{
	global $happiness;

	$happinessCount = 0;

	foreach($arrangement as $i => $personA)
	{
		if($i < (count($arrangement) - 1))
		{
			$personB = $arrangement[$i + 1];
		}
		else
		{
			$personB = $arrangement[0];
		}

		if($personA !== 'me' && $personB !== 'me')
		{
			$happinessCount += $happiness[$personA][$personB];
			$happinessCount += $happiness[$personB][$personA];
		}
	}

	return $happinessCount;
}

$arrangements = pc_permute($guests);

echo 'Number of guests: ' . count($guests) . PHP_EOL;
echo 'Number of possible arrangements: ' . count($arrangements) . PHP_EOL;

$happinessCounts = [];

foreach($arrangements as $arrangement)
{
	$happinessCounts[] = happinessCount($arrangement);
}

echo 'The total happiness for the optimal arrangement is ' . max($happinessCounts) . PHP_EOL;

$guests[] = 'me';
$arrangements = pc_permute($guests);

echo 'Number of guests including myself: ' . count($guests) . PHP_EOL;
echo 'Number of possible arrangements including myself is: ' . count($arrangements) . PHP_EOL;

$happinessCounts = [];

foreach($arrangements as $arrangement)
{
	$happinessCounts[] = happinessCount($arrangement);
}

echo 'The total happiness for the optimal arrangement including myself is ' . max($happinessCounts) . PHP_EOL;

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