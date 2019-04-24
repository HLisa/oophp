<?php

    session_start();
    $_SESSION = array();
    session_destroy();

?>

<p>Session is destroyed. Go back to the
<a href="index_post.php">game</a>.</p>
