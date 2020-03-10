<?php
session_start();
if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
    $a = $_SERVER['HTTP_REFERER'];
    $link = substr( $a, 0, strpos( $a, '?' ) );
	$link = substr($link, 30);
} else {
    $link = '';
}
if ( $link == 'teacher/teacher.php' || $link == 'bulkImport.php' || $link == 'php/signup.inc.php' ) {
} else {
	header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}
?>
<!doctype html>
<html>

<head>
    <link href='css/signup.css' rel='stylesheet' type='text/css'>
    <link href='css/formerrors.css' rel='stylesheet' type='text/css'>
    <script src='http://code.jquery.com/jquery-1.10.1.min.js'></script>
</head>

<body class='login-page'>
    <div class='login-container'>
        <div class='login-panel'>
            <h1>Sign Up</h1>
            <form action='php/signup.inc.php' name='signup-form' method='post' class='signup-form' id='signup-form'>
                <div id='loginFormFields'>
                    <ul>
                        <li class='clearfix'>
                            <label for='role'>User Role</label>
                            <select tabindex=1 name='role' id='role'>
                                <option disabled selected value>Select Role</option>
                                <?php
require( 'php/session.php' );

$sql = 'SELECT * FROM roleTable';
$result = mysqli_query( $connection, $sql );

if ( mysqli_num_rows( $result ) > 0 ) {
    while( $row = mysqli_fetch_assoc( $result ) ) {
        echo "<option value='" . $row['roleID'] . "'>" . $row['roleName'] . '</option>';
    }
}

mysqli_close( $connection );
?>
                            </select>

                            <label for='house'>House</label>
                            <select tabindex=2 name='house' id='house'>
                                <option disabled selected value>Select House</option>
                                <?php
require( 'php/session.php' );

$sql = 'SELECT * FROM houseTable';
$result = mysqli_query( $connection, $sql );

if ( mysqli_num_rows( $result ) > 0 ) {
    while( $row = mysqli_fetch_assoc( $result ) ) {
        echo "<option value='" . $row['houseID'] . "'>" . $row['houseName'] . '</option>';
    }
}

mysqli_close( $connection );
?>

                            </select>
                        </li>

                        <li class='clearfix'>
                            <label for='firstName'>First name</label>
                            <input tabindex=3 type='text' name='firstName' class='alpha-only' placeholder='First name'
                                id='firstname'>
                        </li>

                        <li class='clearfix'>
                            <label for='lastName'>Last name</label>
                            <input tabindex=4 type='text' name='lastName' class='alpha-only' placeholder='Last name'
                                id='lastname'>
                        </li>

                        <li class='clearfix'>
                            <label for='gender'>Gender</label>
                            <select tabindex=5 name='gender' id='gender'>
                                <option disabled selected value>Gender</option>
                                <option value='Male'>Male</option>
                                <option value='Female'>Female</option>
                            </select>
                            <label for='yearLevel'>Year Level</label>
                            <select tabindex=6 name='yearLevel' id='yearlevel'>
                                <option disabled selected value>Year Level</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                            </select>
                        </li>

                        <li class='clearfix'>
                            <label for='dob'>Date of Birth</label>
                            <input tabindex=7 type='text' name='dob' placeholder='Date of Birth'
                                onfocus="(this.type='date')" id='dob'>
                        </li>

                        <li class='clearfix'>
                            <label for='username'>Username</label>
                            <input tabindex=8 type='text' name='username' placeholder='Username' id='username'>
                            <?php
if ( isset( $_SESSION['error'] ) ) {
    echo "<span class='error'>Username already exists.</span>";
}
?>
                        </li>

                        <li class='clearfix'>
                            <label for='password'>Password</label>
                            <input tabindex=9 type='password' name='password' placeholder='Password' id='password'>
                            <?php
if ( isset( $_SESSION['error1'] ) ) {
    echo "<span class='error'>Password must be 6 or more characters.</span>";
}
?>
                        </li>

                        <li class='clearfix'>
                            <label for='passwordConfirm'>Confirm</label>
                            <input tabindex=10 type='password' name='passwordConfirm' placeholder='Confirm'
                                id='passwordconfirm'>
                            <?php
if ( isset( $_SESSION['error2'] ) ) {
    echo "<span class='error'>Passwords do not match.</span>";
}
?>
                        </li>

                        <li class='clearfix'>
                            <input tabindex=11 type='submit' name='signup-submit' id='signup-submit-button'
                                value='Sign Up'>
                            <?php
if ( isset( $_SESSION['emptyfields'] ) ) {
    echo "<span class='error'>Please fill out all fields.</span>";
}
?>
                        </li>
                    </ul>
                </div>
            </form>
            <div class='signupb'><a href='bulkImport.php?userID=<?php echo $_SESSION['userID']?>'>Import from .csv file.</a></div>
            <br>
            <div class='signupb'><a href='teacher/teacher.php?userID=<?php echo $_SESSION['userID']?>'>Return to teacher page.</a></div>
        </div>
    </div>
</body>

<script src='js/alpha-only.js'></script>

</html>

<?php

if ( isset( $_SESSION['emptyfields'] ) && $_SESSION['emptyfields'] == 'emptyfields' ) {
    unset( $_SESSION['emptyfields'] );
}

if ( isset( $_SESSION['error'] ) && $_SESSION['error'] == 'username_i' ) {
    unset( $_SESSION['error'] );

}

if ( isset( $_SESSION['error1'] ) && $_SESSION['error1'] == 'password_i' ) {
    unset( $_SESSION['error1'] );
}

if ( isset( $_SESSION['error2'] ) && $_SESSION['error2'] == 'passwordConfirm_i' ) {
    unset( $_SESSION['error2'] );
}

?>