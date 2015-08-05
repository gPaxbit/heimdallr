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
	$edit = $_POST['row'];
	$src = $_POST['source'];

	if($event == 'edit') {
		if($src == 'ftp') {

			$name = $_POST['name-ftp'];
			$host = $_POST['host-ftp'];
			$login = $_POST['login-ftp'];
			$pwd = $_POST['pwd-ftp'];
			$port = $_POST['port-ftp'];
			$group = $_POST['group-ftp'];

			$query = 'UPDATE [ftp] SET [name]="'.$name.'", [host]="'.$host.'", [login]="'.$login.'", [password]="'.$pwd.'", [port]="'.$port.'", [group]="'.$group.'" WHERE [name]="'.$edit.'"';
			if($db->query($query)) {
				echo 'ftp';
			} else echo $db->lastErrorMsg();

		}

		if($src == 'pwd') {

			$name = $_POST['name-pwd'];
			$login = $_POST['login-pwd'];
			$pwd = $_POST['pwd-pwd'];
			$group = $_POST['group-pwd'];

			$query = 'UPDATE [pwd] SET [name]="'.$name.'", [login]="'.$login.'", [password]="'.$pwd.'", [group]="'.$group.'" WHERE [name]="'.$edit.'"';
			if($db->query($query)) {
				echo 'pwd';
			} else echo $db->lastErrorMsg();

		}
	}
	if($event == 'edit_group') {
		echo $_POST['rnm-group'];
	}
?>