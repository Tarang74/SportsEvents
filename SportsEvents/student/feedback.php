<?php
if(isset($_POST['student-feedback-submit'])) {
	require "../php/session.php";
	
	$sessionID = $feedbackComment = "";
	
	if(!empty($_POST['sessionID'])) {
		$sessionID = $_POST['sessionID'];
	}
	if(!empty($_POST['feedbackComment'])) {
		$feedbackComment = $_POST['feedbackComment'];
	}
	
	if(empty($sessionID) || empty($feedbackComment)) {
		session_start();
		$_SESSION['error1'] = "emptyfields";
		header ("Location: student.php?error=emptyfields");
		exit();
	} else {
		
		$sql = "INSERT INTO feedbackTable (sessionID, feedbackComment) VALUES (?, ?)";
		$stmt = mysqli_stmt_init($connection);
		
		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "is", $sessionID, $feedbackComment);
			mysqli_stmt_execute($stmt);
		}
		mysqli_stmt_close($stmt);
		mysqli_close($connection);
		
		header("Location: student.php?feedback=success");
		exit();
	}
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}