<?php

/**
 * Guess my number, a POST version.
 */
require __DIR__ . "/config.php";
require __DIR__ . "/autoload.php";


$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
$guess = $_POST["guess"] ?? null;


//Start session.
session_name("lihu18");
session_start();

// Give $res a default value.
$res = null;

// Contains the code that may potentially throw an exception.
try {
    if (!isset($_SESSION["object"])) {
        $_SESSION["object"] = new Guess();
        $_SESSION["object"] -> getRandom();
    }

    // Call functions from Guess.php
    $object = $_SESSION["object"];

    // Call function getNumber. Get value $number.
    $number = $object->getNumber();

    // Call function makeGuess to get value $res. Initiate the game.
    if (isset($_POST["doGuess"])) {
        $res = $object->makeGuess($guess);
    } if (isset($_POST["doInit"])) {
        header("Refresh:0");
        session_destroy();
    }
} catch (GuessException $e) {
    echo "Got exception: " . $e->getMessage() . "<hr>";
}

// Call function getTries. Get value $tries.
$tries = $object->getTries();

// Render the page.
require __DIR__ . "/view/guess_number.php";
