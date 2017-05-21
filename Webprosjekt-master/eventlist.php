<?php
require 'dbconnect.php';
?>
<!DOCTYPE html>
<html>
<title>HTML Tutorial</title>
<body>
<?php
error_reporting( E_ALL ); 




	$stmt = "SELECT event_date, event_time, location_ID, age_limit, price, organizer_ID, description 
			FROM `Event` ORDER BY event_date asc, event_time asc";
    $result = $conn->query($stmt);
    
	echo <<<'EOD'
	<table>
		<tr>
			<th>dato</th>
			<th>klokkeslett</th>
			<th>lokasjon</th>
			<th>aldersgrense</th>
			<th>pris</th>
			<th>arrangør</th>
			<th>beskrivelse</th>
		</tr>
EOD;

	foreach ($result as $row) {
		echo '<tr>';
		foreach($row as $k=>$v) { 
			echo "<td>$v</td>";
		}
		echo '</tr>';		
	}
	echo '</table>';

?>
</body>
</html>