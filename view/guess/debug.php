<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Debug the game.

?><hr>
<pre>
SESSION
<?= var_dump($_SESSION) ?>
POST
<?= var_dump($_POST) ?>
GET
<?= var_dump($_GET) ?>
</pre>
</hr>

<?
var_dump($_POST["doGuess"]);
var_dump($_POST["doInit"]);
var_dump($_POST["doCheat"]);
