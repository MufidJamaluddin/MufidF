<?php

	$time_start = microtime(true);

	require_once '../app/autoload.php';
	
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	echo '<br/>Time Executed : '.$time;
	
?>