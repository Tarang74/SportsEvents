<?php
if(isset($_POST['student-session-submit'])) {
	require "../php/session.php";
	
	$userID = $subject = $mentor = $sessionDate = $sessionComment = "";
	
	if(!empty($_POST['userID'])) {
		$userID = $_POST['userID'];
		
		$sql = "SELECT studentID FROM studentTable WHERE userID = " . $userID;
		$result = mysqli_query($connection, $sql);
		
		$row = mysqli_fetch_assoc($result);
		$studentID = $row['studentID'];
	}
	if(!empty($_POST['subject'])) {
		$subject = $_POST['subject'];
	}
	if(!empty($_POST['mentor'])) {
		$mentor = $_POST['mentor'];
	}
	if(!empty($_POST['sessionDate'])) {
		$sessionDate = $_POST['sessionDate'];
	}
	if(!empty($_POST['sessionComment'])) {
		$sessionComment = $_POST['sessionComment'];
	}
	
	if(empty($_POST['subject']) || empty($_POST['mentor']) || empty($_POST['sessionDate'])) {
		session_start();
		$_SESSION['error'] = "emptyfields";
		header ("Location: student.php?error=emptyfields");
		exit();
	} else {
		
		$sql = "INSERT INTO sessionTable (sessionRequestDate, subjectID, studentID, mentorID, sessionComment) VALUES (?, ?, ?, ?, ?)";
		$stmt = mysqli_stmt_init($connection);
		
		if(mysqli_stmt_prepare($stmt, $sql)) {
			mysqli_stmt_bind_param($stmt, "sssss", $sessionDate, $subject, $studentID, $mentor, $sessionComment);
			mysqli_stmt_execute($stmt);
		}
		mysqli_stmt_close($stmt);
		mysqli_close($connection);
		
		header("Location: student.php?booking=success");
		exit();
	}
} else {
	header("HTTP/1.1 404 File Not Found", 404);
	exit();
}