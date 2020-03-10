<?php
if ( isset( $_POST['logout-submit'] ) ) {
    session_start();
    session_unset();
    session_destroy();
    header( 'Location: ../index.php?logout=success' );
} else {
    header( 'HTTP/1.1 404 File Not Found', 404 );
    exit();
}