<?php

	class MyDB extends SQLite3 {
		function __construct() {
			$this->open('../db/main.db');
		}
	}

	function numrows($result) {
		$c = 0;
		while($result->fetchArray(SQLITE3_ASSOC)) {
			$c++;
		}
		return $c;
	}

	$db = new MyDB();
	if(!$db) echo $db->lastErrorMsg();

	$group = 'SELECT * FROM [group] WHERE [parent] = "ftp"';
	$group_row = $db->query($group);
	$i = 0; $r = numrows($group_row);

	while ($row = $group_row->fetchArray(SQLITE3_ASSOC)) {
		$i++;
		$ftp = 'SELECT * FROM [ftp] WHERE [group] = "'.$row['name'].'"';
		$ftp_row = $db->query($ftp);

		echo '<div class="header"><i class="icon">&#xe803;</i> '.$row['name'].'</div>';
		echo '<table>';
		echo '<thead><tr>';
		echo '<td>Name</td><td>Host</td><td>Login</td><td>Password</td><td>Port</td>';
		echo '<td></td><td></td><td></td>';
		echo '</tr></thead>';
		
			if($i == $r) {
				$group_row->finalize();
			}
			while($res = $ftp_row->fetchArray()) {
				echo '<tr>';
				echo '<td>'.$res[0].'</td><td>'.$res[1].'</td><td>'.$res[2].'</td><td>'.$res[3].'</td><td>'.$res[4].'</td>';
				echo '<td class="event"><a href="#" class="edit icon">&#xe812;</a></td>';
				echo '<td class="event"><a href="#" class="remove icon">&#xe80d;</a></td>';
				echo '<td class="event"><a href="#" class="cftp icon">&#xe802;</a></td>';
				echo '</tr>';
			}

		echo '</table>';
	}
		
	$db->close();

?>