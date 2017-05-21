<?php
error_reporting( E_ALL ); 

$username = htmlspecialchars($_POST['username']);
$password =  htmlspecialchars($_POST['password']);

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "Teacheronizuka1";

try {
    $conn = new PDO("mysql:host=$dbservername;dbname=arrangement_db", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM person WHERE username = '$username'");
    $stmt->execute();
    // set the resulting array to associative
    foreach($stmt->fetch(PDO::FETCH_ASSOC) as $k=>$v) { 
		if ($k === 'password'){
			if (password_verify($password, $v)) {
				echo 'you have connected successfully';
			} else {
				echo 'wrong password';
			} 
			break;
		} 
	}
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
