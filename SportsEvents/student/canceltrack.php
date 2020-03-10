<?php
if ( isset( $_POST['canceltrack-submit'] ) ) {
    session_start();
    require '../php/session.php';

    $user = $_POST['userID'];
    $trackevent = $_POST['trackEventID'];
    $date = date( 'Y' );

    $sql = 'DELETE FROM trackApplicationTable WHERE userID = "' . $user . '" ' . 'AND trackEventID =' . ' "' . $trackevent . '" ' . 'AND trackYear =' . ' "' . $date . '"';

    mysqli_multi_query( $connection, $sql );
    mysqli_close( $connection );

    header( 'Location: student.php?cancel=success' );
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}