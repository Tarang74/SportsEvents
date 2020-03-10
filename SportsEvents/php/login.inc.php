<?php

if ( isset( $_POST['login-submit'] ) ) {
    session_start();
    require 'session.php';

    $mailuid = $password = '';

    if ( !empty( $_POST['mailuid'] ) ) {
        $mailuid = $_POST['mailuid'];
    }
    if ( !empty( $_POST['password'] ) ) {
        $password = $_POST['password'];
    }
    if ( empty( $mailuid ) && empty( $password ) ) {
        $_SESSION['username_e'] = 'emptyusername';
        $_SESSION['password_e'] = 'emptypassword';
        header ( 'Location: ../index.php?error=emptyfields' );
        exit();
    }

    if ( empty( $mailuid ) ) {
        $_SESSION['username_e'] = 'emptyusername';
        header ( 'Location: ../index.php?error=emptyfields' );
        exit();
    } elseif ( empty( $password ) ) {
        $_SESSION['password_e'] = 'emptypassword';
        header ( "Location: ../index.php?error=emptyfields&u=$mailuid" );
        exit();
    } else {
        $sql = 'SELECT * FROM logintable WHERE user_username = ? OR emailAddress = ?;';
        $stmt = mysqli_stmt_init( $connection );

        if ( !mysqli_stmt_prepare( $stmt, $sql ) ) {
            header ( 'Location: ../index.php?error=sqlerror' );
            exit();
        } else {
            mysqli_stmt_bind_param( $stmt, 'ss', $mailuid, $mailuid );
            mysqli_stmt_execute( $stmt );
            $result = mysqli_stmt_get_result( $stmt );

            if ( $row = mysqli_fetch_assoc( $result ) ) {
                $passwordCheck = password_verify( $password, $row['user_password'] );
                if ( $passwordCheck == false ) {
                    $_SESSION['password_e'] = 'wrongpassword';
                    header ( 'Location: ../index.php?error=wrongpassword' );
                    exit();
                } elseif ( $passwordCheck == true ) {
                    session_start();

                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['firstname'] = $row['firstName'];
                    $_SESSION['lastname'] = $row['lastName'];
                    $_SESSION['gender'] = $row['gender'];
                    $_SESSION['roleID'] = $row['roleID'];

                    if ( $_SESSION['roleID'] == 3 ) {
                        $string = 'Location: ../student/student.php?userID='.$row['userID'];
                        header( $string );
                    } elseif ( $_SESSION['roleID'] == 2 ) {
                        $string = 'Location: ../teacher/teacher.php?userID='.$row['userID'];
                        header( $string );
                    } elseif ( $_SESSION['roleID'] == 1 ) {
                        $string = 'Location: ../admin/admin.php?userID='.$row['userID'];
                        header( $string );
                    }
                }
            } else {
                $_SESSION['username_e'] = 'nouser';
                header ( 'Location: ../index.php?error=nouser' );
                exit();
            }
        }

    }
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}