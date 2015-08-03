<?php

	include $_SERVER['DOCUMENT_ROOT'].'/lib/connect.php';

	function numrows($result) {
		$c = 0;
		while($result->fetchArray(SQLITE3_ASSOC)) {
			$c++;
		}
		return $c;
	}

	$group = 'SELECT * FROM [group] WHERE [parent] = "pwd"';
	$group_row = $db->query($group);
	$i = 0; $r = numrows($group_row);

	while ($row = $group_row->fetchArray(SQLITE3_ASSOC)) {
		$i++;
		$pwd = 'SELECT * FROM [pwd] WHERE [group] = "'.$row['name'].'"';
		$pwd_row = $db->query($pwd);

		echo '<div id="pwd"><div class="header"><i class="icon">&#xe803;</i> '.$row['name'].'</div>';
		echo '<table>';
		echo '<thead><tr>';
		echo '<td>Name</td><td>Login</td><td>Password</td>';
		echo '<td></td><td></td>';
		echo '</tr></thead>';
		
			if($i == $r) {
				$group_row->finalize();
			}
			while($res = $pwd_row->fetchArray()) {
				echo '<tr>';
				echo '<td>'.$res[0].'</td><td>'.$res[1].'</td><td>'.$res[2].'</td>';
				echo '<td class="event"><a href="#" class="edit icon">&#xe812;</a></td>';
				echo '<td class="event"><a href="#" class="remove icon">&#xe80d;</a></td>';
				echo '</tr>';
			}

		echo '</table></div>';
	}
		
	$db->close();

?>