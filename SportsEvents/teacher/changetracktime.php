<?php
if ( isset( $_POST['changetracktime-submit'] ) ) {
    require '../php/session.php';

    $newtime = $_POST['changetracktime'];
    $newname = $_POST['changetrackname'];
    $event = $_POST['trackID'];

    $sql = 'UPDATE trackEventsTable SET trackEventTime = "' . $newtime . '", trackEventName = "' . $newname . '" WHERE trackID = ' . $event;

    mysqli_multi_query( $connection, $sql );
    mysqli_close( $connection );

    header( 'Location: teacher.php?change=success' );
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}