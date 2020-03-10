<?php
session_start();

if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
    $a = $_SERVER['HTTP_REFERER'];
    $link = substr( $a, 0, strpos( $a, '?' ) );
	$link = substr($link, 30);
} else {
    $link = '';
}
if ( $link == 'teacher/teacher.php' || $link == 'signup.php' || $link == 'php/bulkImport.inc.php' ) {
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
            <h1>Import Data</h1>
            <form action='php/bulkImport.inc.php' name='bulkimport-form' method='post' enctype='multipart/form-data'
                class='signup-form' id='signup-form'>
                <div id='loginFormFields'>
                    <ul>
                        <li class='clearfix'>
                            <label for='import'>Import Data</label>
                            <input type='file' name='fileToUpload' id='fileToUpload' accept='.csv' required>
                        </li>
                        <li class='clearfix'>
                            <label for='role'>Select User</label>
                            <select name='role' required>
                                <option disabled selected value>User</option>
                                <option value='3'>Student</option>
                                <option value='2'>Teacher</option>
                            </select>
                            <script type='text/javascript'>
                            function download(d) {
                                if (d == '.csv Format') return;
                                window.location = d;
                            }
                            </script>
                            <label for='template'>Template for Upload</label>
                            <select name='template' onChange='download(this.value)'>
                                <option disabled selected value>Download Guide</option>
                                <option value='studentUploadTemplate.csv'>Student</option>
                                <option value='teacherUploadTemplate.csv'>Teacher</option>
                            </select>
                        </li>
                        <li class='clearfix'>
                            <input type='submit' name='bulkimport-submit' id='bulkimport-submit-button' value='Upload'>
                            <?php
if ( isset( $_SESSION['uploaderror'] ) ) {
    echo "<span class='error'>File is invalid, please try again.</span>";
}
?>
                        </li>
                    </ul>
                </div>
            </form>
            <div class='signupb'><a href='signup.php?userID=<?php echo $_SESSION['userID']?>'>Return to single signup.</a></div>
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