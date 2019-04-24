<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the game.
    if (!isset($_SESSION["object"])) {
        $_SESSION["object"] = new Lihu\Guess\Guess();
        $_SESSION["object"]->getRandom();
    }

        $object = $_SESSION["object"];
        $number = $object->getNumber();

    return $app->response->redirect("guess/play");
});


/**
 * Play the game. Show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $object = $_SESSION["object"];
    // $number = $object->getNumber();
    $tries = $object->getTries();

    // Get current settings from the SESSION.
    $guess = $_SESSION["guess"] ?? null;
    $res = $_SESSION["res"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "number" => $number ?? null,
        "tries" => $tries,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "doInit" => $doInit ?? null,
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game. Make a guess and initiate the game.
 */
$app->router->post("guess/play", function () use ($app) {

    // Deal with incoming variables.
    $object = $_SESSION["object"] ?? null;
    $guess = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    // Get current settings from the SESSION.
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $res = null;

    if (isset($_POST["doGuess"])) {
        // Make a guess.
        $res = $object->makeGuess($guess);
        $_SESSION["tries"] = $tries;
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    } if (isset($_POST["doInit"])) {
        // Initiate the game.
        $_SESSION["object"] = new Lihu\Guess\Guess();
        $_SESSION["object"]->getRandom();
    } if (isset($_POST["doCheat"])) {
        // Cheat.
        $number = $object->getNumber();
    }

    // var_dump($_POST["doCheat"]);

    return $app->response->redirect("guess/play");
});


// /**
//  * Cheat in the game.
//  */
// $app->router->post("guess/play", function () use ($app) {
//
//     // Deal with incoming variables.
//     $object = $_SESSION["object"] ?? null;
//     $doCheat = $_POST["doCheat"] ?? null;
//
//     // Get current settings from the SESSION.
//     // $number = $_SESSION["number"] ?? null;
//     // $tries = $_SESSION["tries"] ?? null;
//     // $res = null;
//
//     if (isset($_POST["doCheat"])) {
//         $number = $object->getNumber();
//     }
//
//     return $app->response->redirect("guess/play");
// });
