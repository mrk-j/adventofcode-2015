<?php
ini_set('memory_limit', '8192M');

$input = file_get_contents('input.txt');
$rows = explode("\n", $input);

$replacements = [];
$replacementsReverse = [];
$molecules = '';

foreach($rows as $row)
{
	if(strpos($row, '=>') !== false)
	{
		list($molecule, $replacement) = explode(' => ', $row);

		$replacements[$molecule][] = $replacement;
		$replacementsReverse[$replacement] = $molecule;
	}
	elseif(trim($row) !== '')
	{
		$molecules = $row;
	}
}

foreach($replacements as $molecule => $replacement)
{
	foreach($replacement as $value)
	{
		if(strpos($molecules, $value) !== false)
		{
			$replacementsForMolecule[$molecule][] = $value;
		}
	}
}

$createdMolecules = [];

for($i = 0; $i < strlen($molecules); $i++)
{
	for($j = 1; $j <= 2; $j++)
	{
		if(isset($replacements[substr($molecules, $i, $j)]))
		{
			$molecule = substr($molecules, $i, $j);

			foreach($replacements[$molecule] as $replacement)
			{
				$createdMolecules[] = substr($molecules, 0, $i) . $replacement . substr($molecules, $i + $j);
			}

			if($j > 1)
			{
				$i = $i + ($j - 1);
			}
		}
	}
}

echo 'The number of unique molecules is ' . count(array_unique($createdMolecules)) . PHP_EOL;

$createdMolecules = [];

function replace($input, $step = 1)
{
	global $replacementsReverse, $createdMolecules;

	if($input === 'e')
	{
		echo 'Molecule found after ' . ($step - 1) . ' steps' . PHP_EOL;
	}

	$createdMolecule = $input;

	foreach($replacementsReverse as $molecule => $replacement)
	{
		if(($pos = strpos($createdMolecule, $molecule)) !== false)
		{
			$createdMolecule = substr($createdMolecule, 0, $pos) . $replacement . substr($createdMolecule, $pos + strlen($molecule));

			$step++;		
		}	
	}

	if(!in_array($createdMolecule, $createdMolecules))
	{
		$createdMolecules[] = $createdMolecule;

		replace($createdMolecule, $step);
	}
}

replace($molecules);