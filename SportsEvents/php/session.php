<?php

if ( count( get_required_files() ) == 1 || count( get_included_files() ) == 1 ) {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
} else {
    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'sportsevents';

    $connection = mysqli_connect( $host, $dbUsername, $dbPassword, $dbName );

    if ( !$connection ) {
        die( 'SQL Connection Failed: '. mysqli_connect_error() );
    }
}