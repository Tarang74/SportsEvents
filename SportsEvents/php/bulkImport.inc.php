<?php

if ( isset( $_POST['bulkimport-submit'] ) ) {
    session_start();

    require 'session.php';

    if ( $_FILES['fileToUpload']['name'] ) {
        $fileName = explode( '.', $_FILES['fileToUpload']['name'] );

        if ( $fileName[1] == 'csv' ) {
            $handle = fopen( $_FILES['fileToUpload']['name'], 'r' );
            $row = 1;
            while( $data = fgetcsv( $handle, 5000, ',' ) ) {
                if ( $row == 1 ) {
                    $row++;
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );
                    $c0 = mysqli_real_escape_string( $connection, $data[0] );

                    continue;
                }

                $col0 = mysqli_real_escape_string( $connection, $data[0] );
                $col1 = mysqli_real_escape_string( $connection, $data[2] );
                $col2 = mysqli_real_escape_string( $connection, $data[3] );
                $col3 = mysqli_real_escape_string( $connection, $data[4] );
                $col4 = mysqli_real_escape_string( $connection, $data[5] );
                $col5 = mysqli_real_escape_string( $connection, $data[6] );
                $col6 = mysqli_real_escape_string( $connection, $data[7] );
                $col7 = mysqli_real_escape_string( $connection, $data[8] );
                $col8 = mysqli_real_escape_string( $connection, $data[9] );

                $sql = 'INSERT INTO loginTable()';
                mysqli_query( $connection, $sql );
            }
            fclose ( $handle );

            if ( $data == null ) {
                $_SESSION['uploaderror'] = 'error';
                header( 'Location: ../bulkimport.php?error=empty' );
                exit();
            } else {

            }
        }

        // if ( mysqli_stmt_prepare( $stmt, $sql ) ) {
        //     mysqli_stmt_bind_param( $stmt, 'sisssisss', $userRole, $house,  $firstName, $lastName, $gender, $yearLevel, $emailAddress, $username, $p_password );
        //     $p_password = password_hash( $password, PASSWORD_DEFAULT );
        //     mysqli_stmt_execute( $stmt );
        //     mysqli_stmt_close( $stmt );

        //     $sql1 = 'INSERT INTO ' . $userRole . 'Table (userID) SELECT MAX(userID) AS userID FROM userTable';
        //     mysqli_query( $connection, $sql1 );

        //     if ( $userRole == 'mentor' ) {
        //         $sql2 =
        //         "SELECT MAX(mentorID) AS m_mentorID
		// 			FROM mentorTable";
        //         $result = mysqli_query( $connection, $sql2 );
        //         $row = mysqli_fetch_assoc( $result );
        //         $rowmentor = $row['m_mentorID'];

        //         $sql3 = 'INSERT INTO mentorSubjectTable (mentorID, subjectID) VALUES (?, ?)';
        //         $stmt1 = mysqli_stmt_init( $connection );

        //         if ( mysqli_stmt_prepare( $stmt1, $sql3 ) ) {
        //             mysqli_stmt_bind_param( $stmt1, 'ii', $rowmentor, $subject );
        //             mysqli_stmt_execute( $stmt1 );
        //             mysqli_stmt_close( $stmt1 );
        //         }
        //     }
        // }
    }
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}