<?php

class Guess
{
    private $number;
    private $tries;


/**
* Constructor to initiate the object with current game settings if availible.
* Randomize the current number if no value is sent in.
*
* @param int $number The current secret number, default -1 to initiate
*                    the number from start.
* @param int $tries  Number of tries a guess has been made,
*                    default 6.
*/

    public function __construct(int $number = null, int $tries = 6)
    {
        if ($this->number == -1) {
            $this->getRandom();
        }
        $this->number = $number;
        $this->tries = $tries;
    }


// Function to randomize secret number to initiate anew game.
    public function getRandom()
    {
        $this->number = rand(1, 100);
    }


// Function to get number of tries left.
    public function getTries()
    {
        return $this->tries;
    }


// Function to get the secret number.
    public function getNumber()
    {
        return($this->number);
    }


/**
* Function to make a guess, decrease the remaining guesses and return a string stating status of the guess or i no guesses remain.
* @throws GuessException when guessed number is out of bounds.
*
* @return string to show the status of the guess made.
*/

    public function makeGuess($guess)
    {
        $this->tries -= 1;
        if (!($guess > 0 && $guess <= 100)) {
            throw new GuessException("You must enter a number between 1 and 100.");
        }
        if ($this->tries <= 0) {
            $this->number = null;
            $res = "GAME OVER! Play again by pressing 'Start from beginning'";
        } elseif ($guess > $this->number && $this->tries > 0) {
            $res = "TOO HIGH";
        } elseif ($guess < $this->number && $this->tries > 0) {
             $res = "TOO LOW";
        } else {
             $res = "CORRECT! Play again by pressing 'Start from beginning'";
        } return $res;
    }

/**
* Reset game.
* @return void
*/
    public function resetGame()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }


/**
* Destroy a Game
* @return void
*/
    public function __destruct()
    {
    }
}
