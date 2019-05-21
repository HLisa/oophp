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
    $_SESSION["dice"] = new Lihu\Dice\DiceHand();
    // $dice = new Lihu\Dice\DiceHand();
    // $comp = new Lihu\Dice\DiceComp();
    return $app->response->redirect("dice/play");
});


/**
 * Play the game. Show game status.
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game";

    $dice = $_SESSION["dice"];

    // Player
    $values = $_SESSION["values"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $sumRound = $_SESSION["sumRound"] ?? null;
    $sumTotal = $_SESSION["sumTotal"] ?? null;
    //Comp
    $valuesComp = $_SESSION["valuesComp"] ?? null;
    $resComp = $_SESSION["resComp"] ?? null;
    $sumRoundComp = $_SESSION["sumRoundComp"] ?? null;
    $sumTotalComp = $_SESSION["sumTotalComp"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["resComp"] = null;
    $_SESSION["values"] = null;
    $_SESSION["valuesComp"] = null;
    $_SESSION["reset"] = null;
    $_SESSION["comp"] = null;
    $_SESSION["sumTotal"] = null;
    $_SESSION["sumTotalComp"] = null;

    // Data
    $data = [
        "dice" => $dice ?? null,
        "res" => $res,
        "resComp" => $res,
        "values" => $values ?? null,
        "sumRound" => $sumRound ?? null,
        "sumTotal" => $sumTotal ?? null,
        "valuesComp" => $valuesComp ?? null,
        "sumRoundComp" => $sumRoundComp ?? null,
        "sumTotalComp" => $sumTotalComp ?? null,
        "roll" => $roll ?? null,
        "save" => $save ?? null,
        "reset" => $reset ?? null,
        "comp" => $comp ?? null,
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game. Roll die, save points or reset the game.
 */
$app->router->post("dice/play", function () use ($app) {

    // Deal with incoming variables.
    $dice = $_SESSION["dice"];

    $dice = $_SESSION["dice"] ?? null;
    $roll = $_POST["roll"] ?? null;
    $save = $_POST["save"] ?? null;
    $reset = $_POST["reset"] ?? null;
    $comp = $_POST["comp"] ?? null;

    // PLayer
    $values = $_SESSION["values"] ?? null;
    $sumRound = $_SESSION["sumRound"] ?? null;
    $sumTotal = $_SESSION["sumTotal"] ?? null;
    $res = null;

    // Comp
    $valuesComp = $_SESSION["valuesComp"] ?? null;
    $sumRoundComp = $_SESSION["sumRoundComp"] ?? null;
    $sumTotalComp = $_SESSION["sumTotalComp"] ?? null;
    $resComp = null;

    if (isset($_POST['roll'])) {
        $values = $dice->getValues();
        $sumRound = $dice->getSumRound();
        $sumRound = $_SESSION["dice"]->getRoundTotal();
        $_SESSION["values"] = $values;
        $_SESSION["sumRound"] = $sumRound;
        $_SESSION["res"] = $res;
    }
    if (isset($_POST['reset'])) {
        // $app->response->redirect("dice/init");
        $_SESSION["dice"]->initGame();
    }
    if (isset($_POST['save'])) {
        // Player
        $_SESSION["dice"]->saveRound();
        $sumTotal = $_SESSION["dice"]->getSavedTotal();
        $_SESSION["sumTotal"] = $sumTotal;
        $_SESSION["res"] = $res;
        // Comp
        $valuesComp = $dice->getValuesOne();
        $sumRoundComp = $dice->getSumRoundComp();
        $sumRoundComp = $dice->getRoundTotalComp();
        $_SESSION["dice"]->saveRoundComp();
        $sumTotalComp = $_SESSION["dice"]->getSavedTotalComp();
        $_SESSION["valuesComp"] = $valuesComp;
        $_SESSION["sumRoundComp"] = $sumRoundComp;
        $_SESSION["resComp"] = $resComp;
        $_SESSION["sumTotalComp"] = $sumTotalComp;
    }

    if (isset($_POST['comp'])) {
        // Player
        // $_SESSION["dice"]->saveRound();
        $sumTotal = $_SESSION["dice"]->getSavedTotal();
        $_SESSION["sumTotal"] = $sumTotal;
        $_SESSION["res"] = $res;
        // Comp
        $valuesComp = $dice->getValuesOne();
        $sumRoundComp = $dice->getSumRoundComp();
        $sumRoundComp = $dice->getRoundTotalComp();
        $_SESSION["dice"]->saveRoundComp();
        $sumTotalComp = $_SESSION["dice"]->getSavedTotalComp();
        $_SESSION["valuesComp"] = $valuesComp;
        $_SESSION["sumRoundComp"] = $sumRoundComp;
        $_SESSION["resComp"] = $resComp;
        $_SESSION["sumTotalComp"] = $sumTotalComp;
    }

    return $app->response->redirect("dice/play");
});
