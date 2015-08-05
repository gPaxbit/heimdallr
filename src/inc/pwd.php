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

		$numr = numrows($pwd_row);

		if($numr != 0){
			echo '<div id="pwd"><div class="header"><i class="icon">&#xe803;</i> <span>'.$row['name'];
			echo '</span><a href="#" title="Delete" class="icon delete-group">&#xe80d;</a>';
			echo '<a href="#" title="Edit" class="icon edit-group">&#xe812;</a>';
			echo '</div>';
			echo '<table>';
			echo '<thead><tr>';
			echo '<td>Name</td><td>Login</td><td>Password</td>';
			echo '<td></td><td></td>';
			echo '</tr></thead>';
				while($res = $pwd_row->fetchArray()) {
					echo '<tr>';
					echo '<td>'.$res[0].'</td><td>'.$res[1].'</td><td>'.$res[2].'</td>';
					echo '<td class="event"><a href="#" title="Edit" class="edit icon" data-target="pwd">&#xe812;</a></td>';
					echo '<td class="event"><a href="#" title="Delete" class="remove icon" data-target="pwd">&#xe80d;</a></td>';
					echo '</tr>';
				}	
			echo '</table></div>';
		}
	}

	echo '<form method="POST" id="edit" class="sideRight">';
	echo '<h3>Edit row</h3>';
	echo '<input type="hidden" name="row" id="row" value="" />';
	echo '<input type="hidden" name="source" id="source" value="pwd" />';
	echo '<input type="text" name="name-pwd" id="name-pwd" placeholder="Name" />';
	echo '<input type="text" name="login-pwd" id="login-pwd" placeholder="Login" />';
	echo '<input type="text" name="pwd-pwd" id="pwd-pwd" placeholder="Password" />';
	echo '<select name="group-pwd">';

	while ($opt = $group_row->fetchArray(SQLITE3_ASSOC)) {
		echo '<option>'.$opt['name'].'</option>';
	}

	echo '</select>';
	echo '<input type="submit" name="save-pwd" value="Save" id="save-pwd" />';
	echo '<a href="#" class="cancel">Cancel</a>';
	echo '</form>';
		
	$db->close();

?>