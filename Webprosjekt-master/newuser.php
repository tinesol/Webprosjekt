<?php
error_reporting( E_ALL ); 

$username = htmlspecialchars($_POST['username']);
$password =  htmlspecialchars($_POST['password']);
$email =  htmlspecialchars($_POST['email']);
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO person(email, password, usertype, username) VALUES ('" . $email . "', '" . $password_hash .  "', 'student', '" . $username . "')";
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "Teacheronizuka1";

try {
    $conn = new PDO("mysql:host=$dbservername;dbname=arrangement_db", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
$conn = null;

?>
