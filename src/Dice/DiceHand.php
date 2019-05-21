<?php

namespace Lihu\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     */

    private $values;
    private $sum;
    private $sumRound;
    private $sumTotal;
    private $valuesComp;
    private $sumRoundComp;
    private $sumTotalComp;
    private $serie;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct()
    {
        // $this->dices  = $dices;
        // $this->sides = $sides;
        $this->values = null;
        $this->sum = null;
        $this->sumRound = null;
        $this->sumTotal = null;
        $this->valuesComp = null;
        $this->sumRoundComp = null;
        // $this->sumTotalComp = null;

        $this->serie = array();
        // int $dices = 2, int $sides = 6
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        // $this->values = [];
        for ($i = 0; $i < 2; $i++) {
            $this->value = rand(1, 6);
        }
        return $this->value;
        // return $this->values;
    }


    /**
     * Get values from die.
     *
     * @return int as the sum of all die.
     */
    public function getValues()
    {
        $this->values[0] = $this->roll();
        $this->values[1] = $this->roll();
        return [$this->values[0],
                $this->values[1]];
    }


    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function getSumRound()
    {
        $this->sumRound = array_sum($this->values) + $this->sumRound;
        if (in_array(1, $this->values) == false) {
            return $this->sumRound;
        }
    }

    /**
    * Initiate the round, sumRound is 0.
    *
    */
    public function initRound()
    {
        $this->sumRound = null;
        $this->serie = array();
    }

    /**
    * Initiate the game, sumValues, sumRound and sumTotal is 0.
    *
    */
    public function initGame()
    {
        $this->value = null;
        $this->values = null;
        $this->sumRound = null;
        $this->sumTotal = null;
        $this->valueComp = null;
        $this->valuesComp = null;
        $this->sumRoundComp = null;
        $this->sumTotalComp = null;
        $this->serie = array();
    }

    /**
    * Save points and initiate new round.
    *
    */
    public function saveRound()
    {
        if (in_array(1, $this->values) == false) {
            $this->sumTotal += $this->sumRound;
            $this->initRound();
        }
    }

    /**
    * Get the sum of the round, or 0 if no roll has been made.
    *
    */
    public function getRoundTotal()
    {
        $round = $this->sumRound;

        if (in_array(1, $this->values) == true) {
            $res = $round;
            $res = "<p><b>Du slog en etta och kan inte spara.. Klicka på 'Datorns tur'.</b></p>";
            $this->initRound();
        } else if ($this->sumRound >= 100) {
            $res = $round;
            $res = "<b>Du lyckades komma till 100 utan att spara!</b>";
            $this->initGame();
        } else {
            $res =  $round;
        } return $res;
    }

    /**
     * Display the saved points
     *
     */
    public function getSavedTotal()
    {
        $result = "<b>Din poäng:</b> " . $this->sumTotal;
        // $saved = isset($this->sumTotal) && $this->sumTotal > 0 ? $result : null;
        // $res = "<p>" . $saved . "</p>";

        if ($this->sumTotal >= 100) {
            $res = "<b>Du har nått 100 poäng!</b>";
            $this->initGame();
        } else {
            $res = $result;
        }
        return $res;
    }


    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function rollComp()
    {
        for ($i = 0; $i < 2; $i++) {
            $this->valueComp = rand(1, 6);
        }
        return $this->valueComp;
    }

    /**
     * Get values from die.
     *
     * @return int as the sum of all die.
     */
    public function getValuesOne()
    {
        $this->valuesComp[0] = $this->rollComp();
        $this->valuesComp[1] = $this->rollComp();
        if (in_array(1, $this->valuesComp) == false) {
            $this->valuesComp[2] = $this->rollComp();
            $this->valuesComp[3] = $this->rollComp();
            return [$this->valuesComp[0],
                    $this->valuesComp[1],
                    $this->valuesComp[2],
                    $this->valuesComp[3]];
        }
    }


    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function getSumRoundComp()
    {
        $this->sumRoundComp = array_sum($this->valuesComp) + $this->sumRoundComp;
        if (in_array(1, $this->valuesComp) == false) {
            return $this->sumRoundComp;
        }
    }

    /**
    * Initiate the round, sumRound is 0.
    *
    */
    public function initRoundComp()
    {
        $this->sumRoundComp = null;
        $this->serie = array();
    }


    /**
    * Save points and initiate new round.
    *
    */
    public function saveRoundComp()
    {
        if (in_array(1, $this->valuesComp) == false) {
            $this->sumTotalComp += $this->sumRoundComp;
            $this->initRoundComp();
        }
    }

    /**
    * Get the sum of the round, or 0 if no roll has been made.
    *
    */
    public function getRoundTotalComp()
    {
        $roundComp = $this->sumRoundComp;

        if (in_array(1, $this->valuesComp) == true) {
            $this->initRoundComp();
        } else if ($this->sumRoundComp >= 100) {
            $resComp = $roundComp;
            $resComp = "<b>Datorn vann..</b>";
            $this->initGame();
        } else {
            $resComp =  $roundComp;
        } return $resComp;
    }

    /**
     * Display the saved points
     *
     */
    public function getSavedTotalComp()
    {
        $result = "<b>Datorns poäng:</b> " . $this->sumTotalComp;
        // $saved = isset($this->sumTotal) && $this->sumTotal > 0 ? $result : null;
        // $res = "<p>" . $saved . "</p>";

        if ($this->sumTotalComp >= 100) {
            $resComp = "<b>Du har förlorat..</b>";
            $this->initGame();
        } else {
            $resComp = $result;
        }
        return $resComp;
    }



    /**
     * @var int $lastRoll  Value of the last roll.
     */
    //private $lastRoll;
    protected $lastRoll;
}
