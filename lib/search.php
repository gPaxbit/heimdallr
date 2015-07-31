<?php

	require 'connect.php';

	function numrows($result) {
		$c = 0;
		while($result->fetchArray()) {
			$c++;
		}
		return $c;
	}

	$group = $_POST['group'];
	$search = $_POST['search'];

	if($search) {

		$sql = 'SELECT * FROM '.$group.' WHERE name LIKE "%'.$search.'%" UNION SELECT * FROM '.$group.' WHERE host LIKE "%'.$search.'%" ';
		$result = $db->query($sql);
		$count = numrows($result);

		if(!$result){ echo $db->lastErrorMsg(); } 
		else {
			echo <<<EOF
			<table><thead><tr>
				<td>NAME</td>
				<td>HOST</td>
				<td>LOGIN</td>
				<td>PASSWORD</td>
			</tr></thead>
EOF;
			while($row = $result->fetchArray()) {
				echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
			}
			echo "</table>";
		}

		$db->close();
	}

?>