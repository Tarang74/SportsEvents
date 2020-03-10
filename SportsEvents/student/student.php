<?php session_start();
?>
<?php if ( !isset( $_SESSION['userID'] ) ) {
    header( 'Location: ../index.php?error=timeout' );
    exit();
}
?>
<!doctype html>
<html>

<head>
    <title>Student Page</title>
    <link href='../css/main.css' rel='stylesheet' type='text/css'>
    <link href='../css/main-form.css' rel='stylesheet' type='text/css'>
    <link href='../css/formerrors.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <?php require( '../header.php' );
?>
    <main>
        <div class='section'>
            <h3>Track Events</h3>
            <table class='main-table'>
                <thead>
                    <tr>
                        <th>Event Time</th>
                        <th>Track Distance</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
require( '../php/session.php' );

$sql = "
					SELECT
						trackEventID,
						trackEventName,
						trackEventTime
					FROM
						trackEventTable
					ORDER BY
						trackEventTime ASC";

$result = mysqli_query( $connection, $sql );

while( $row = mysqli_fetch_assoc( $result ) ) {
    echo
    "<tr>
		<td>" . $row['trackEventTime'] . "</td>
		<td>" . $row['trackEventName'] . "</td>
		<td>";

    $sql1 = 'SELECT trackEventID FROM trackApplicationTable WHERE userID = "' . $_SESSION['userID'] . '" AND trackYear = "' . date( 'Y' ) . '" ORDER BY trackEventID';
    $result1 = mysqli_query( $connection, $sql1 );

    $count = 0;
    while( $row1 = mysqli_fetch_assoc( $result1 ) ) {
        if ( $row1['trackEventID'] == $row['trackEventID'] ) {
            $count += 1;
        }
    }
    if ( $count == 1 ) {
        echo "<form action='canceltrack.php' method='post'>
			<input type='hidden' name='trackEventID' value='" . $row['trackEventID'] . "'>
			<input type='hidden' name='userID' value='" . $_SESSION['userID'] . "'>
			<input type='submit' name='canceltrack-submit' value='Cancel'>
		</form>";
    }
    if ( $count == 0 ) {
        echo "<form action='applytrack.php' method='post'>
			<input type='hidden' name='trackEventID' value='" . $row['trackEventID'] . "'>
			<input type='hidden' name='userID' value='" . $_SESSION['userID'] . "'>
			<input type='submit' name='applytrack-submit' value='Apply'>
		</form>";
    }
    echo '</td></tr>';
}

mysqli_close( $connection );
?>
                </tbody>
            </table>
        </div>
        <div class='section'>
            <h3>Book Session</h3>
            <form action='booking.php' method='post' name='booking-form'>
                <input name='userID' style='display: none;' value="<?php echo $_SESSION['userID'];?>">
                <table class='main-form'>
                    <tbody>
                        <tr>
                            <td>
                                <label for='subject'>Select Subject</label>
                            </td>
                            <td>
                                <select name='subject'>
                                    <option hidden disabled selected value>Select Subject</option>
                                    <?php
require( '../php/session.php' );

$sql = 'SELECT * FROM subjectTable ORDER BY subjectName ASC';
$result = mysqli_query( $connection, $sql );

if ( mysqli_num_rows( $result ) > 0 ) {
    while( $row = mysqli_fetch_assoc( $result ) ) {
        echo "<option value='" . $row['subjectID'] . "'>" . $row['subjectName'] . '</option>';
    }
}

mysqli_close( $connection );
?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='mentor'>Select Mentor</label>
                            </td>
                            <td>
                                <select name='mentor'>
                                    <option hidden disabled selected value>Select Mentor</option>
                                    <?php
require '../php/session.php';
$sql = "
									SELECT mentorTable.mentorID, firstname, lastname, yearlevel, houseName, subjectName
									FROM mentorTable
									LEFT JOIN userTable ON mentorTable.userID = userTable.userID
									LEFT JOIN houseTable ON userTable.houseID = houseTable.houseID
									LEFT JOIN mentorSubjectTable ON mentorTable.mentorID = mentorSubjectTable.mentorID
									LEFT JOIN subjectTable ON mentorSubjectTable.subjectID = subjectTable.subjectID
									ORDER BY lastname ASC";

$result = mysqli_query( $connection, $sql );

if ( mysqli_num_rows( $result ) > 0 ) {
    while( $row = mysqli_fetch_assoc( $result ) ) {
        echo "<option value='" . $row['mentorID'] . "'>" . '(' . substr( $row['houseName'], 0, 1 ) . ') ' . $row['firstname'] . ' ' . $row['lastname'] . ' - ' . $row['yearlevel'] . ' ' . $row['subjectName'] . '</option>';
    }
} else {
    echo '<option>No mentors available</option>';
}
mysqli_close( $connection );
?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='sessionDate'>Choose Date</label>
                            </td>
                            <td>
                                <input type='date' name='sessionDate' id='todaydate' min=''>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='sessionComment'>Add a comment</label>
                            </td>
                            <td>
                                <input type='textarea' name='sessionComment'>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type='submit' name='student-session-submit' value='Book Session'>
            </form>
            <?php
if ( isset( $_SESSION['error'] ) && $_SESSION['error'] == 'emptyfields' ) {
    echo "<span class='error'>Please fill out all fields.</span>";
}
?>
        </div>

        <div class='section'>
            <h3>Feedback</h3>
            <form action='feedback.php' method='post' name='feedback-form'>
                <table class='main-form'>
                    <tbody>
                        <tr>
                            <td>
                                <label for='sessionID'>Select Session</label>
                            </td>
                            <td>
                                <select name='sessionID'>
                                    <option hidden disabled selected value>Select Session</option>
                                    <?php
require( '../php/session.php' );

$string = "
							SELECT *
							FROM sessionTable
							LEFT JOIN studentTable ON sessionTable.studentID = studentTable.studentID
							WHERE completed = 1 AND studentTable.userID = " . $_SESSION['userID'];
$sql = $string;
$result = mysqli_query( $connection, $sql );

if ( mysqli_num_rows( $result ) > 0 ) {
    while( $row = mysqli_fetch_assoc( $result ) ) {
        echo "<option value='" . $row['sessionID'] . "'>" .
        $row['sessionRequestDate'] . '</option>';
    }
}
mysqli_close( $connection );
?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='feedbackComment'>Add a comment</label>
                            </td>
                            <td>
                                <input type='textarea' name='feedbackComment'>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <input type='submit' name='student-feedback-submit' value='Submit Feedback'>

            </form>
            <?php
if ( isset( $_SESSION['error1'] ) && $_SESSION['error1'] == 'emptyfields' ) {
    echo "<span class='error'>Please fill out all fields.</span>";
}
?>
        </div>

        <script src='../js/todaydate.js'></script>
    </main>

</body>

</html>

<?php

if ( isset( $_SESSION['error'] ) || isset( $_SESSION['error1'] ) || isset( $_SESSION['error3'] ) ) {
    unset( $_SESSION['error'] );
    unset( $_SESSION['error1'] );
    unset( $_SESSION['error3'] );
}

?>