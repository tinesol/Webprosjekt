<!DOCTYPE html>
<html>
<title>HTML Tutorial</title>
<body>
<?php
error_reporting( E_ALL ); 

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "Teacheronizuka1";

try {
    $conn = new PDO("mysql:host=$dbservername;dbname=arrangement_db", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT event_date, event_time, location_ID, age_limit, price, organizer_ID, description FROM arrangement ORDER BY event_date asc, event_time asc");
    $stmt->execute();
    
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

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo '<tr>';
		foreach($row as $k=>$v) { 
			echo "<td>$v</td>";
		}
		echo '</tr>';		
	}
	echo '</table>';
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
</body>
</html>