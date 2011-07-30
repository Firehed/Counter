Command Line Progress Counter
=============================

A simple tool to track the progress of your upgrades and other long-running
tasks. It has the added benefit over a simple homegrown system by displaying the
counter on the current output line.

This is not intended for web usage - it is designed around CLI scripts. It was
designed for upgrade scripts that run on tens of thousands of objects where
upgrades by SQL queries are not a practical solution (cache interference, logic
better handled in PHP, etc.) but should work for anything that needs a counter,
such as unit test output or deployment scripts.

Usage
-----

	upgrader.php:

	<?php
	include './counter.php';
	$things_to_upgrade = array(); // DB result, iterator, etc.
	counter::start('Some thing that needs upgrading', count($things_to_upgrade));
	foreach ($things_to_upgrade as $thing) {
		$pass = $thing->upgrade(); // return true on success, false on fail
		counter::next($pass ? '.' : 'E');
	}

Output
------

During upgrades:

	$ php upgrader.php

	Some thing that needs upgrading:
	........................E........................            049/500

After completion:

	$ php upgrader.php

	Some thing that needs upgrading:
	........................E........................E.......... 060/500
	..............E........................E.................... 120/500
	....E........................E........................E..... 180/500
	...................E........................E............... 240/500
	.........E........................E........................E 300/500
	........................E........................E.......... 360/500
	..............E........................E.................... 420/500
	....E........................E........................E..... 480/500
	...................E                                         500/500

	$



