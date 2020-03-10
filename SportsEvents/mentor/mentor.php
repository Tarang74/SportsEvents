<?php session_start() ?>
<?php if(!isset($_SESSION['userID'])) {
	header("Location: ../index.php?error=timeout");
	exit();
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Mentor Page</title>
    <link rel="stylesheet" href="../css/main.css" type="text/css">

</head>

<body>

    <?php require("../header.php")?>

    <main>
        <div class="section">
            <h3>Sessions</h3>
            <table class="main-table">
                <tr>
                    <th>Date</th>
                    <th>Subject</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Availability</th>
                    <th>Status</th>
                    <th>Feedback</th>
                </tr>
                <?php
			require ("../php/session.php");
			
			$sql = "SELECT sessionRequestDate, subjectName, firstName, lastName, yearLevel, sessionComment, available, completed, sessionTable.sessionID, feedbackComment
			FROM sessionTable
			RIGHT JOIN mentorTable ON sessionTable.mentorID = mentorTable.mentorID
			LEFT JOIN subjectTable ON sessionTable.subjectID = subjectTable.subjectID
			LEFT JOIN studentTable ON sessionTable.studentID = studentTable.studentID
			LEFT JOIN userTable ON studentTable.userID = userTable.userID
			LEFT JOIN feedbackTable ON sessionTable.sessionID = feedbackTable.sessionID
			WHERE mentorTable.userID = " . $_SESSION['userID'];
			
			
			$result = mysqli_query($connection, $sql);
			
			
			if(mysqli_num_rows($result) > 0) {				

				while($row = mysqli_fetch_assoc($result)) {
				
				if($row['available'] == 1) {
					$available_svg = "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 130.2 130.2'>
					<circle class='path circle' fill='none' stroke='#73AF55' stroke-width='6' stroke-miterlimit='10' cx='65.1' cy='65.1' r='62.1'/>
					<polyline class='path check' fill='none' stroke='#73AF55' stroke-width='6' stroke-linecap='round' stroke-miterlimit='10' points='100.2,40.2 51.5,88.8 29.8,67.5'/>
				</svg>";
				} else {
					$available_svg = "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 130.2 130.2'>
					<circle class='path circle' fill='none' stroke='#D06079' stroke-width='6' stroke-miterlimit='10' cx='65.1' cy='65.1' r='62.1'/>	
					<line class='path line' fill='none' stroke='#D06079' stroke-width='6' stroke-linecap='round' stroke-miterlimit='10' x1='34.4' y1='37.9' x2='95.8' y2='92.3'/>
					<line class='path line' fill='none' stroke='#D06079' stroke-width='6' stroke-linecap='round' stroke-miterlimit='10' x1='95.8' y1='38' x2='34.4' y2='92.2'/>
				</svg>";
				}
				if ($row['completed'] == "1") {
					$complete_text = "Completed";
				} else {
					$complete_text = "Not Completed";
				}		
					
				echo "
				<tr>
				<td>" . $row['sessionRequestDate'] . "</td>
				<td>" . $row['subjectName'] . "</td>
				<td>" . $row['firstName'] . " " . $row['lastName'] . " - " . $row['yearLevel'] . "</td>
				<td>" . $row['sessionComment'] . "</td>
				<td>" .
						"<form name='available-form' action='available.php' method='post'>
						<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
						<label class='available-label'>
							<input style='display:none' type='submit' name='available-submit' value='Available'>" . 
							$available_svg .
						"</label>
						</form>" .
				"</td>
				<td>" .
						"<form name='completed-session-form' action='completed.php' method='post'>
						<input style='display: none;' name='sessionID' value='" . $row['sessionID'] . "'>
						<input class='complete-input' type='submit' name='completed-session-submit' value='" . $complete_text . "'>
						</form>" .
				"</td>
				<td>" . $row['feedbackComment'] . "</td>
				</tr>";
				} 
			} else {
			mysqli_close($connection);	
			}
			mysqli_close($connection);
			?>
            </table>
        </div>
    </main>
</body>

</html>