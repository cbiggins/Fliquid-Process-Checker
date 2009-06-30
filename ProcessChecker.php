<?php

$proc = $argv[1];
$newproc = $argv[2];
$email = $argv[3];

$ps = system('ps axo comm | grep -i ' . $proc, $ret);

if ($ret == 1) { // Process is not running
	$subject = "Process " . $proc . " not running";
	$msg = "";
	if (strlen($newproc) > 0) { // Do we have a process to start?
		system($newproc, $ok);

		if ($ok == 127) { // Not able to start the process
			$msg .= "There was an error starting the new process!";
		} else if ($ok == 255) { // Started ok
			$msg .= "The new process " . $newproc . " was started sucessfully";
			$subject .= " -- restarted at " . date("%Y/%m/%d %H:%M");
		}
	}
}
print $subject;


?>
