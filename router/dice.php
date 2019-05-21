<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the game.
    if (!isset($_SESSION["dice"])) {
        $_SESSION["dice"] = new Lihu\Dice\Dice();
        // $value = $dice->roll();
    }

    $dice = $_SESSION["dice"];

    return $app->response->redirect("dice/play");
});


/**
 * Play the game. Show game status.
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game";

    $dice = $_SESSION["dice"];
    // $value = $dice->roll();
    // $values = $dice->getValues();

    // Get current settings from the SESSION.
    $dice = $_SESSION["dice"] ?? null;
    $value = $_SESSION["value"] ?? null;
    $values = $_SESSION["values"] ?? null;

    $_SESSION["value"] = null;
    $_SESSION["values"] = null;

    $data = [
        "value" => $value ?? null,
        "values" => $values ?? null,
        "total" => $total ?? null,
        "rollDice" => $rollDice ?? null,
        "savePoints" => $savePoints ?? null,
        "resetGame" => $resetGame ?? null,
        "changePlayer" => $resetGame ?? null,
    ];

    $app->page->add("dice/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game by rolling the dices.
 */
$app->router->post("dice/play", function () use ($app) {

    // Deal with incoming variables.
    $rollDice = $_POST["rollDice"] ?? null;
    $savePoints = $_POST["savePoints"] ?? null;
    $resetGame = $_POST["resetGame"] ?? null;
    $changePlayer = $_POST["changePlayer"] ?? null;

    // Get current settings from the SESSION.
    $dice = $_SESSION["dice"] ?? null;
    $values = null;
    $total = null;

    if (isset($_POST["rollDice"])) {
        // Roll dice.
        $values = $dice->getValuesA();
        $_SESSION["values"] = $values;
    } if (isset($_POST["savePoints"])) {
        // Save points.
        $total = $dice->savePointsA();
        $_SESSION["total"] = $total;
    }if (isset($_POST["resetGame"])) {
        // Reset game.
        $_SESSION["dice"] = new Lihu\Dice\Dice();
        // $value = $dice->roll();
    } if (isset($_POST["changePlayer"])) {
        // Change player.
    }

    return $app->response->redirect("dice/play");
});
