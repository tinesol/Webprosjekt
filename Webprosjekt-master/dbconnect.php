<?php
	
	$host = "tek.westerdals.no";
	$name = "leanh16_gruppeprosjekt_v17";
	$username = "leanh16_admin";
	$password = "vaselinA45";

	$conn = new mysqli($host, $username, $password, $name);
// ---- debugging ----
if($conn->connect_errno) {
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $conn->connect_errno . "\n";
    echo "Error: " . $conn->connect_error . "\n";
    exit;
}