<?php

	include $_SERVER['DOCUMENT_ROOT'].'/lib/connect.php';

	function numrows($result) {
		$c = 0;
		while($result->fetchArray(SQLITE3_ASSOC)) {
			$c++;
		}
		return $c;
	}

	$event = $_POST['event'];
	$src = $_POST['source'];

	if($event) {

		if($src == 'ftp') {

			$name = $_POST['name'];
			$host = $_POST['host'];
			$login = $_POST['login'];

			$query = 'DELETE FROM [ftp] WHERE [name]="'.$name.'" AND [host]="'.$host.'" AND [login]="'.$login.'"';

			if($db->query($query)) {
				echo 'ftp';
			} else echo $db->lastErrorMsg();

		}

		if($src == 'pwd') {

			$name = $_POST['name'];
			$pwd = $_POST['pwd'];
			$login = $_POST['login'];

			$query = 'DELETE FROM [pwd] WHERE [name]="'.$name.'" AND [password]="'.$pwd.'" AND [login]="'.$login.'"';

			if($db->query($query)) {
				echo 'pwd';
			} else echo $db->lastErrorMsg();

		}
	}
?>