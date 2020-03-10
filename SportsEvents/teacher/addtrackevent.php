<?php
if ( isset( $_POST['addtrackevent-submit'] ) ) {
    session_start();
    require '../php/session.php';
    $time = $_POST['addtracktime'];
    $name = $_POST['addtrackname'];

    $sql = 'INSERT INTO trackEventTable (trackEventName, trackEventTime) VALUES ("' . $name . '", "' . $time . '")';

    mysqli_multi_query( $connection, $sql );
    mysqli_close( $connection );

    header( 'Location: teacher.php?add=success' );
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}