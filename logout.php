<?php
    
    if (session_id()) {
        session_commit();
    }
    session_start();
    session_regenerate_id(true); 
    $current_session_id = session_id();
    session_commit();

    session_id($session_id_to_destroy);
    session_start();
    session_destroy();
    session_commit();
    session_id($current_session_id);
    session_start();
    session_commit();
    
    header("Location: index.php");
?>
    
