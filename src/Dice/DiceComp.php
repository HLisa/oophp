<?php

namespace Lihu\Dice;

include_once(__DIR__ . "/DiceHand.php");

/**
 * Class player.
 */
class DiceComp extends DiceHand
{
    // private $sumComp;
    private $totalComp;
    private $runTime;
    private $throwOne;
    private $throwTwo;
    private $throwThree;

    public function __construct(int $runTime = 3)
    {
        parent::__construct();
        // $this->sumComp = parent::$values;
        $this->totalComp = 0;
        $this->runTime = $runTime;
        $this->throwOne = 0;
        $this->throwTwo = 0;
        $this->throwThree = 0;
    }
}
