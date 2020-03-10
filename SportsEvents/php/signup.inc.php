<?php

if ( isset( $_POST['signup-submit'] ) ) {
    session_start();

    require 'session.php';

    if ( $_POST['role'] == 2 ) {

        $firstName = $lastName = $gender = $dob = $username = $password = $passwordConfirm = $roleID = '';

        $fn_e = $ln_e = $g_e = $d_e = $u_e = $p_e = $pc_e = $ur_e = $u_i = $p_i = $pc_i = '';

        if ( !empty( $_POST['firstName'] ) ) {
            $firstName = $_POST['firstName'];
        } else {
            $fn_e = '&empty=fn';
        }

        if ( !empty( $_POST['lastName'] ) ) {
            $lastName = $_POST['lastName'];
        } else {
            $ln_e = '&empty=ln';
        }

        if ( !empty( $_POST['gender'] ) ) {
            $gender = $_POST['gender'];
        } else {
            $g_e = '&empty=g';
        }

        if ( !empty( $_POST['dob'] ) ) {
            $dob = $_POST['dob'];
        } else {
            $d_e = '&empty=d';
        }

        if ( !empty( $_POST['username'] ) ) {

            $sql = 'SELECT user_username FROM loginTable WHERE user_username = ?';
            $stmt = mysqli_stmt_init( $connection );

            if ( mysqli_stmt_prepare( $stmt, $sql ) ) {
                mysqli_stmt_bind_param( $stmt, 's', $_POST['username'] );
                mysqli_stmt_execute( $stmt );
                mysqli_stmt_store_result( $stmt );
                $resultCheck = mysqli_stmt_num_rows( $stmt );

                if ( $resultCheck == 0 ) {
                    $username = $_POST['username'];
                } else {
                    $u_i = '&invalid=u';
                }
            } else {
                header( 'Location: ../signup.php?error=sqlerror' );
                exit();
            }
        } else {
            $u_e = '&empty=u';
        }

        if ( empty( $_POST['password'] ) ) {
            $p_e = '&empty=p';
        } elseif ( empty( $_POST['passwordConfirm'] ) ) {
            $pc_e = '&empty=pc';
        } elseif ( strlen( $_POST['password'] ) < 6 ) {
            $p_i = '&invalid=p';
        } elseif ( $_POST['password'] !== $_POST['passwordConfirm'] ) {
            $pc_i = '&invalid=pc';
        } else {
            $password = $_POST['password'];
        }

        if ( !empty( $_POST['role'] ) ) {
            $roleID = $_POST['role'];
        } else {
            $ur_e = '&empty=ur';
        }

        if ( $fn_e || $ln_e || $g_e || $d_e || $u_e || $p_e || $pc_e || $ur_e || $u_i || $p_i || $pc_i ) {
            $empty = '';
            $invalid = '';

            if ( $fn_e || $ln_e || $g_e || $d_e || $u_e || $p_e || $pc_e || $ur_e ) {
                $empty = "$fn_e$ln_e$g_e$d_e$u_e$p_e$pc_e$ur_e";
            }

            if ( $u_i || $p_i || $pc_i ) {
                $invalid = "$u_i$p_i$pc_i";
            }

            $message = password_hash( $empty . $invalid, PASSWORD_DEFAULT );

            if ( !empty( $empty ) || !empty( $invalid ) ) {
                if ( $fn_e || $ln_e || $g_e || $d_e || $u_e || $p_e || $pc_e ) {
                    $_SESSION['emptyfields'] = 'emptyfields';
                }

                if ( $u_i ) {
                    $_SESSION['error'] = 'username_i';
                }

                if ( $p_i ) {
                    $_SESSION['error1'] = 'password_i';
                }

                if ( $pc_i ) {
                    $_SESSION['error2'] = 'passwordConfirm_i';
                }

                header( "Location: ../signup.php?$message" );
                exit();
            }
        }

        if ( empty( $fn_e ) && empty( $ln_e ) && empty( $g_e ) && empty( $d_e ) && empty( $u_e ) && empty( $p_e ) && empty( $pc_e ) && empty( $ur_e ) && empty( $u_i ) && empty( $p_i ) && empty( $pc_i ) ) {

            $sql = 'INSERT INTO loginTable (roleID, firstName, lastName, gender, userDob, emailAddress, user_username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_stmt_init( $connection );

            $emailAddress = $username.'@citipointe.qld.edu.au';

            if ( mysqli_stmt_prepare( $stmt, $sql ) ) {
                mysqli_stmt_bind_param( $stmt, 'isssssss', $roleID,  $firstName, $lastName, $gender, $dob, $emailAddress, $username, $p_password );
                $p_password = password_hash( $password, PASSWORD_DEFAULT );
                mysqli_stmt_execute( $stmt );
                mysqli_stmt_close( $stmt );

                $sql1 = 'INSERT INTO teacherTable (userID) SELECT MAX(userID) AS userID FROM loginTable';
                mysqli_query( $connection, $sql1 );

            }

            mysqli_close( $connection );

            header( 'Location: ../index.php?signup=success' );
            exit();
        }

    } elseif ( $_POST['role'] == 3 ) {

        $firstName = $lastName = $gender = $yearLevel = $username = $password = $passwordConfirm = $roleID = $house = $dob = '';

        $fn_e = $ln_e = $g_e = $yl_e = $u_e = $p_e = $pc_e = $ur_e = $h_e = $d_e = $u_i = $p_i = $pc_i = '';

        if ( !empty( $_POST['firstName'] ) ) {
            $firstName = $_POST['firstName'];
        } else {
            $fn_e = '&empty=fn';
        }

        if ( !empty( $_POST['lastName'] ) ) {
            $lastName = $_POST['lastName'];
        } else {
            $ln_e = '&empty=ln';
        }

        if ( !empty( $_POST['gender'] ) ) {
            $gender = $_POST['gender'];
        } else {
            $g_e = '&empty=g';
        }

        if ( !empty( $_POST['yearLevel'] ) ) {
            $yearLevel = $_POST['yearLevel'];
        } else {
            $yl_e = '&empty=yl';
        }

        if ( !empty( $_POST['username'] ) ) {

            $sql = 'SELECT user_username FROM loginTable WHERE user_username = ?';
            $stmt = mysqli_stmt_init( $connection );

            if ( mysqli_stmt_prepare( $stmt, $sql ) ) {
                mysqli_stmt_bind_param( $stmt, 's', $_POST['username'] );
                mysqli_stmt_execute( $stmt );
                mysqli_stmt_store_result( $stmt );
                $resultCheck = mysqli_stmt_num_rows( $stmt );

                if ( $resultCheck == 0 ) {
                    $username = $_POST['username'];
                } else {
                    $u_i = '&invalid=u';
                }
            } else {
                header( 'Location: ../signup.php?error=sqlerror' );
                exit();
            }
        } else {
            $u_e = '&empty=u';
        }

        if ( empty( $_POST['password'] ) ) {
            $p_e = '&empty=p';
        } elseif ( empty( $_POST['passwordConfirm'] ) ) {
            $pc_e = '&empty=pc';
        } elseif ( strlen( $_POST['password'] ) < 6 ) {
            $p_i = '&invalid=p';
        } elseif ( $_POST['password'] !== $_POST['passwordConfirm'] ) {
            $pc_i = '&invalid=pc';
        } else {
            $password = $_POST['password'];
        }

        if ( !empty( $_POST['role'] ) ) {
            $roleID = $_POST['role'];
        } else {
            $ur_e = '&empty=ur';
        }

        if ( !empty( $_POST['house'] ) ) {
            $house = $_POST['house'];
        } else {
            $h_e = '&empty=h';
        }

        if ( !empty( $_POST['dob'] ) ) {
            $dob = $_POST['dob'];
        } else {
            $d_e = '&empty=d';
        }

        if ( $fn_e || $ln_e || $g_e || $yl_e || $u_e || $p_e || $pc_e || $ur_e || $h_e || $d_e || $u_i || $p_i || $pc_i ) {
            $empty = '';
            $invalid = '';

            if ( $fn_e || $ln_e || $g_e || $yl_e || $u_e || $p_e || $pc_e || $ur_e || $h_e || $d_e ) {
                $empty = "$fn_e$ln_e$g_e$yl_e$u_e$p_e$pc_e$ur_e$h_e$d_e";
            }

            if ( $u_i || $p_i || $pc_i ) {
                $invalid = "$u_i$p_i$pc_i";
            }

            $message = password_hash( $empty . $invalid, PASSWORD_DEFAULT );

            if ( !empty( $empty ) || !empty( $invalid ) ) {
                if ( $fn_e || $ln_e || $g_e || $yl_e || $u_e || $p_e || $pc_e || $ur_e || $h_e || $d_e ) {
                    $_SESSION['emptyfields'] = 'emptyfields';
                }

                if ( $u_i ) {
                    $_SESSION['error'] = 'username_i';
                }

                if ( $p_i ) {
                    $_SESSION['error1'] = 'password_i';
                }

                if ( $pc_i ) {
                    $_SESSION['error2'] = 'passwordConfirm_i';
                }

                header( "Location: ../signup.php?$message" );
                exit();
            }
        }

        if ( empty( $fn_e ) && empty( $ln_e ) && empty( $yl_e ) && empty( $u_e ) && empty( $p_e ) && empty( $pc_e ) && empty( $ur_e ) && empty( $d_e ) && empty( $u_i ) && empty( $p_i ) && empty( $pc_i ) ) {

            $sql = 'INSERT INTO loginTable (roleID, houseID, firstName, lastName, gender, yearLevel, userDob, emailAddress, user_username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_stmt_init( $connection );

            $emailAddress = $username.'@citipointe.qld.edu.au';

            if ( mysqli_stmt_prepare( $stmt, $sql ) ) {
                mysqli_stmt_bind_param( $stmt, 'iissssisss', $roleID, $house, $firstName, $lastName, $gender, $dob, $yearLevel, $emailAddress, $username, $p_password );
                $p_password = password_hash( $password, PASSWORD_DEFAULT );
                mysqli_stmt_execute( $stmt );
                mysqli_stmt_close( $stmt );

                $sql1 = 'INSERT INTO studentTable (userID) SELECT MAX(userID) AS userID FROM loginTable';
                mysqli_query( $connection, $sql1 );

            }

            mysqli_close( $connection );

            header( 'Location: ../index.php?signup=success' );
            exit();
        }
    }
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}