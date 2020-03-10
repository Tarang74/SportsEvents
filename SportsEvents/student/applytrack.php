<?php
if ( isset( $_POST['applytrack-submit'] ) ) {
    session_start();
    require '../php/session.php';

    $user = $_POST['userID'];
    $trackevent = $_POST['trackEventID'];

    $sql = 'INSERT INTO trackApplicationTable (userID, trackEventID) VALUES ("' . $user . '", "' . $trackevent . '")';

    mysqli_multi_query( $connection, $sql );
    mysqli_close( $connection );

    header( 'Location: student.php?add=success' );
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}