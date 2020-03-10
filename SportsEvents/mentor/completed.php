<?php
if(isset($_POST['completed-session-submit'])) {
	require "../php/session.php";

	$sql = "UPDATE sessionTable
					SET completed = !completed
					WHERE sessionID = " . $_POST['sessionID'];
	
	mysqli_query($connection, $sql);
	mysqli_close($connection);
	
	header("Location: mentor.php?rolechange=success");
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}