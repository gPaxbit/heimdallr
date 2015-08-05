<?php

	include $_SERVER['DOCUMENT_ROOT'].'/lib/connect.php';

	function numrows($result) {
		$c = 0;
		while($result->fetchArray(SQLITE3_ASSOC)) {
			$c++;
		}
		return $c;
	}

	$group = 'SELECT * FROM [group] WHERE [parent] = "ftp"';
	$group_row = $db->query($group);
	$i = 0; $r = numrows($group_row);

	while ($row = $group_row->fetchArray(SQLITE3_ASSOC)) {
		$i++;
		$ftp = 'SELECT * FROM [ftp] WHERE [group] = "'.$row['name'].'"';
		$ftp_row = $db->query($ftp);

		$numr = numrows($ftp_row);

		//echo $numr;

		if($numr != 0) {
			echo '<div id="ftp"><div class="header"><i class="icon">&#xe803;</i> <span>'.$row['name'];
			echo '</span><a href="#" title="Delete" class="icon delete-group">&#xe80d;</a>';
			echo '<a href="#" title="Edit" class="icon edit-group">&#xe812;</a>';
			echo '</div>';
			echo '<table>';
			echo '<thead><tr>';
			echo '<td>Name</td><td>Host</td><td>Login</td><td>Password</td><td>Port</td>';
			echo '<td></td><td></td><td></td>';
			echo '</tr></thead>';
			
				while($res = $ftp_row->fetchArray()) {
					echo '<tr>';
					echo '<td>'.$res[0].'</td><td>'.$res[1].'</td><td>'.$res[2].'</td><td>'.$res[3].'</td><td>'.$res[4].'</td>';
					echo '<td class="event"><a href="#" title="Edit" class="edit icon" data-target="ftp">&#xe812;</a></td>';
					echo '<td class="event"><a href="#" title="Delete" class="remove icon" data-target="ftp">&#xe80d;</a></td>';
					echo '<td class="event"><a href="#" title="Connect to ftp" class="cftp icon">&#xe802;</a></td>';
					echo '</tr>';
				}
			
			echo '</table></div>';
		}
	}

	echo '<form method="POST" id="edit" class="sideRight">';
	echo '<h3>Edit row</h3>';
	echo '<input type="hidden" name="row" id="row" value="" />';
	echo '<input type="hidden" name="source" id="source" value="ftp" />';
	echo '<input type="text" name="name-ftp" id="name-ftp" placeholder="Name" />';
	echo '<input type="text" name="host-ftp" id="host-ftp" placeholder="Host" />';
	echo '<input type="text" name="login-ftp" id="login-ftp" placeholder="Login" />';
	echo '<input type="text" name="pwd-ftp" id="pwd-ftp" placeholder="Password" />';
	echo '<input type="text" name="port-ftp" id="port-ftp" placeholder="Port" />';
	echo '<select name="group-ftp">';

	while ($opt = $group_row->fetchArray(SQLITE3_ASSOC)) {
		echo '<option>'.$opt['name'].'</option>';
	}

	echo '</select>';
	echo '<input type="submit" name="save-ftp" value="Save" id="save-ftp" />';
	echo '<a href="#" class="cancel">Cancel</a>';
	echo '</form>';

	$db->close();

?>