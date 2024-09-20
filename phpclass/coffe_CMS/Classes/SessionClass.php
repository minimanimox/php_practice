<?php
    // // to use session first you need to start the session.
    // // conditionally if the front-end is sending a session ID, e.g, using POST method then you need to continue the previous session.
    // session_id($_POST["sid"]);
    // session_start(); //if session ID will be presented, if the session ID exists, session_start will continue the previous session. If it does not exist it will create a new session.
    // $_SESSION['timeout'] = time() + 1000 // when user logged in or the session is still hasn't timed out then set/reset the timeout 
    // if(isset($_SESSION['timeout']) && $_SESSION['timeout'] > time() )
    // echo session_id(); // to send a created session ID back to the front-end
    // $_SESSION["login_user"] = $user; // to store a value into a session array
    // session_status() === PHP_SESSION_ACTIVE // check if sessions are enabled and one exists
    // // to terminate a session use the following in order:
    // session_unset(); // to free all session variables
    // session_destroy(); // Destroy the session and any possible data registered to the session.
?>