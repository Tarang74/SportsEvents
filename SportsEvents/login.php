<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Index/login</title>
    <link href='css/login.css' rel='stylesheet' type='text/css'>
    <link href='css/formerrors.css' rel='stylesheet' type='text/css'>
</head>

<body class='login-page'>
    <div class='login-container'>
        <div class='login-panel'>
            <h1>CITIPOINTE ATHLETICS</h1>
            <form action='php/login.inc.php' class='login-form' method='post' name='login' id='login'>
                <div id='loginFormFields'>
                    <ul>
                        <li class='clearfix'>
                            <label for='mailuid'>Username</label>
                            <input maxlength='50' name='mailuid' placeholder='username' type='text'>
                        </li>
                        <?php
if ( isset( $_SESSION['username_e'] ) && $_SESSION['username_e'] == 'emptyusername' ) {
    echo "<span class='error'>Please enter username.</span>";
}
if ( isset( $_SESSION['username_e'] ) && $_SESSION['username_e'] == 'nouser' ) {
    echo "<span class='error'>Username does not exist.</span>";
}
?>
                        <li class='clearfix'>
                            <label for='password'>Password</label>
                            <input autocomplete='off' name='password' placeholder='password' type='password'>
                        </li>
                        <?php
if ( isset( $_SESSION['password_e'] ) && $_SESSION['password_e'] == 'emptypassword' ) {
    echo "<span class='error'>Please enter password.</span>";
}
if ( isset( $_SESSION['password_e'] ) && $_SESSION['password_e'] == 'wrongpassword' ) {
    echo "<span class='error'>Password is incorrect.</span>";
}
?>
                        <li class='clearfix hover'>
                            <input class='button expand' id='entry-login' name='login-submit' type='submit'
                                value='Sign In'>
                        </li>
                    </ul>
                </div>
            </form>
            <div class='signupb'><a href='https://central.citipointe.qld.edu.au/login/'>Return to Citipointe Central</a>
            </div>
        </div>
    </div>
</body>

</html>
<?php

if ( isset( $_SESSION['username_e'] ) || isset( $_SESSION['password_e'] ) ) {
    unset( $_SESSION['username_e'] );
    unset( $_SESSION['password_e'] );
}

?>