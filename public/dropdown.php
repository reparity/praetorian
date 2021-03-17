<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "praetorian";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    echo "<select name=\"a_name\">";
	echo "<option value=\"0\">---No agent---</option>";

	$asql = "SELECT * FROM agents";
	$aresult = $conn->query($asql);

	echo "<select name='aname'>";
	while ($arrow = $aresult->fetch_assoc()) {
    echo "<option value='" . $arrow['id'] ."'>" . $arrow['name'] ."</option>";
	}
	echo "</select>";
?>