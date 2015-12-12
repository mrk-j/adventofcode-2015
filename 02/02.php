<?php
$input = file_get_contents('input.txt');
$packages = explode("\n", $input);
$paper = 0;

foreach($packages as $package)
{
	$sizes = explode('x', $package);

	list($l, $w, $h) = $sizes;

	$sides = [
		$l * $w,
		$w * $h,
		$l * $h
	];

	$paper += array_sum($sides) * 2 + min($sides);
}

echo 'The elves should order ' . $paper . ' square feet of wrapping paper' . PHP_EOL;