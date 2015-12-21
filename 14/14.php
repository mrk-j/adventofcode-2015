<?php
$input = file_get_contents('input.txt');
$reindeers = [];

foreach(explode("\n", $input) as $reindeer)
{
	$parts = explode(' ', $reindeer);

	$reindeers[] = new Reindeer($parts[0], $parts[3], $parts[6], $parts[13]);
}

class Reindeer
{
	private $name, $topSpeed, $flyDuration, $restDuration, $points = 0;

	public function __construct($name, $topSpeed, $flyDuration, $restDuration)
	{
		$this->name = $name;
		$this->topSpeed = $topSpeed;
		$this->flyDuration = $flyDuration;
		$this->restDuration = $restDuration;
	}

	public function getDistanceTravelled($seconds)
	{
		$distanceTravelled = 0;

		$cycles = $seconds / ($this->flyDuration + $this->restDuration);
		$fullCycles = floor($cycles);

		$distanceTravelled += $fullCycles * $this->topSpeed * $this->flyDuration;

		$timeLeft = $seconds - ($fullCycles * ($this->flyDuration + $this->restDuration));

		if($timeLeft >= $this->flyDuration)
		{
			$distanceTravelled += $this->flyDuration * $this->topSpeed;
		}
		else
		{
			$distanceTravelled += $timeLeft * $this->topSpeed;
		}

		return $distanceTravelled;
	}

	public function getName()
	{
		return $this->name;
	}

	public function addPoint()
	{
		$this->points++;
	}

	public function getPoints()
	{
		return $this->points;
	}
}

$time = 2503;

foreach($reindeers as $reindeer)
{
	echo $reindeer->getName() . ' travelled ' . $reindeer->getDistanceTravelled($time) . PHP_EOL;
}

for($i = 1; $i <= $time; $i++)
{
	$furthestDistance = 0;
	$firstReindeers = [];

	foreach($reindeers as $reindeer)
	{
		$distance = $reindeer->getDistanceTravelled($i);

		if($distance == $furthestDistance)
		{
			$firstReindeers[] = $reindeer;
		}
		elseif($distance > $furthestDistance)
		{
			$furthestDistance = $distance;

			$firstReindeers = [$reindeer];
		}
	}

	foreach($firstReindeers as $reindeer)
	{
		$reindeer->addPoint();
	}
}

foreach($reindeers as $reindeer)
{
	echo $reindeer->getName() . ' has ' . $reindeer->getPoints() . ' points' . PHP_EOL;
}