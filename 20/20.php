<?php
$input = 34000000;
$house = 1;
$numberOfDeliveredGiftsPerElf = [];

while(true)
{
	$elvesWithGifts = [];	
	$elvesWithGiftsPart2 = [];

	$elves = sqrt($house); 

	for($elve = 1; $elve <= $elves; $elve++)
	{
		if($house % $elve === 0)
		{
			$elvesWithGifts[] = $elve;
			$elvesWithGifts[] = $house / $elve;
		}
	}

	foreach(array_unique($elvesWithGifts) as $elve)
	{
		if(!isset($numberOfDeliveredGiftsPerElf[$elve]) || $numberOfDeliveredGiftsPerElf[$elve] < 50)
		{
			$elvesWithGiftsPart2[] = $elve;
		}

		if(isset($numberOfDeliveredGiftsPerElf[$elve]))
		{
			$numberOfDeliveredGiftsPerElf[$elve]++;
		}
		else
		{
			$numberOfDeliveredGiftsPerElf[$elve] = 1;
		}
	}

	foreach(array_unique($elvesWithGifts) as $elve)
	{
		
	}

	$gifts = array_sum(array_unique($elvesWithGifts)) * 10;
	$giftsPart2 = array_sum(array_unique($elvesWithGiftsPart2)) * 11;

	if($house % 10000 === 0 )
	{
		//echo 'Checking house ' . $house . ' (' . $gifts . ' gifts / ' . $giftsPart2 . ' gifts)' . PHP_EOL;
	}

	if($giftsPart2 > $input)
	{
		echo 'House ' . $house . ' gets ' . $giftsPart2 . ' gifts (Part 2)' . PHP_EOL;

		break;
	}
	
	if($gifts > $input)
	{
		echo 'House ' . $house . ' gets ' . $gifts . ' gifts (Part 1)' . PHP_EOL;		
	}

	$house++;
}