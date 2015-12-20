<?php
ini_set('memory_limit', '1024M');

$input = '1113122113';

function lookAndSay($input, $times)
{
	for($i = 0; $i < $times; $i++)
	{
		$input = str_split($input);
		$output = '';
		$lastValue = '';

		foreach($input as $key => $value)
		{
			if($value === $lastValue)
			{
				continue;
			}

			$count = 0;

			for($j = $key; $j < count($input); $j++)
			{
				if($input[$j] !== $value)
				{
					break;
				}

				$count++;
			}

			$output .= $count . $value;
			$lastValue = $value;
		}

		$input = $output;
	}

	return $input;
}

echo 'Length of result after 40 passes is ' . strlen(lookAndSay($input, 40)) . PHP_EOL;
echo 'Length of result after 50 passes is ' . strlen(lookAndSay($input, 50)) . PHP_EOL;