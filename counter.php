<?php

class counter {

	const LINE = 60; //items per line, not including the actual counter

	static $i,$count,$extra,$cw,$new=true;

	public static function start($text,$count) {
		if (!self::$new)
			echo "\n"; // only add linebreak at beginning after first run (avoid i==count in highly looped next() function)
		echo "$text:\n";
		self::$new = false;
		self::$i=0;
		self::$count=$count;
		self::$cw = strlen($count);
		self::$extra = self::$cw * 2 + 2;
		echo str_repeat(' ', self::LINE);
		$pct = '%0'.self::$cw.'d';
		printf(" $pct/$pct",0,self::$count);
	}

	public static function next($chr) {
		$mod = self::$i % self::LINE;
		!$mod && self::$i && print "\n"; // syntactic sugar to say it's after hitting the line break but not 0

		echo str_repeat("\010", self::$extra + self::LINE-$mod); // backspace over prev run spaces + $extra: ' XXXX/XXXX'
		echo $chr;
		self::$i++;

		echo str_repeat(' ', self::LINE - $mod); // spaces after output to numeric counter (incl. space between output and numbers)
		echo sprintf('%0'.self::$cw.'d/%0'.self::$cw.'d', self::$i, self::$count);
	}

}

