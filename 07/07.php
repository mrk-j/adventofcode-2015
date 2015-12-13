<?php
$input = file_get_contents('input.txt');
$instructions = explode("\n", $input);
$outputs = [];

foreach($instructions as $instruction)
{
	list($input, $output) = explode(' -> ', $instruction);

	$outputs[$output] = $input;
}

function getWireSignal($output)
{
	global $outputs;

	if(is_numeric($output))
	{
		return (int) $output;
	}

	if(!isset($outputs[$output]))
	{
		die('Output doesn\'t exist! :( = ' . $output);
	}

	$input = explode(' ', $outputs[$output]);

	if(count($input) === 1)
	{
		$outputs[$output] = getWireSignal($outputs[$output]);
	}
	elseif($input[0] === 'NOT')
	{
		$outputs[$output] =  ~ getWireSignal($input[1]);
	}
	else
	{
		$a = getWireSignal($input[0]);
		$b = getWireSignal($input[2]);

		switch($input[1])
		{
			case 'AND':
				$outputs[$output] = $a & $b;
				break;
			case 'OR':
				$outputs[$output] = $a | $b;
				break;
			case 'LSHIFT':
				$outputs[$output] = $a << $b;
				break;
			case 'RSHIFT':
				$outputs[$output] = $a >> $b;
				break;
		}
	}

	return $outputs[$output];
}

$a = getWireSignal('a');

echo 'The signal for wire a is ' . $a . PHP_EOL;

foreach($instructions as $instruction)
{
	list($input, $output) = explode(' -> ', $instruction);

	$outputs[$output] = $output === 'b' ? $a : $input;
}

echo 'The signal for wire a is ' . getWireSignal('a') . PHP_EOL;