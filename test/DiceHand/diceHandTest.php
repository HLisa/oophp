<?php

namespace Lihu\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Just assert something is true.
     */
    public function testConstruct()
    {
    $dice = new DiceHand();
    $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);
    }

    /**
     * Just assert something is true.
     */

    public function testRoll()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

        $res = $dice->roll();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetValues()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getValues();
         $exp = [0];
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetSumRound()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getSumRound();
         $exp = array_sum([1]);
         $this->assertEquals($exp, $res);
    }

    public function testIfStatementGetSumRound()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getSumRound();
         $exp = false;
         $this->assertEquals($exp, $res);
    }


    /**
    * Just assert something is true.
    */
    public function testInitRound()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->initRound();
         $exp = null;
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testInitGame()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->initGame();
         $exp = null;
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testSaveRound()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->saveRound();
         $exp = $dice->sumRound;
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetRoundTotal()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

        $res = $dice->getRoundTotal();
        $exp = in_array(1, $dice->values);
        $this->assertEquals($exp, $res);
    }

    public function testIfStatementGetRoundTotal()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getRoundTotal();
         $exp = $res;
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetSavedTotal()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

        $res = $dice->getSavedTotal();
        $exp = 101;
        $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testIfStatementGetSavedTotal()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

        $res = $dice->getSavedTotal();
        $exp = $dice->sumRound;
        $this->assertEquals($exp, $res);
    }


    /**
     * Just assert something is true.
     */

    public function testRollComp()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

        $res = $dice->rollComp();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetValuesOne()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getValuesOne();
         $exp = [0];
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetSumRoundComp()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getSumRoundComp();
         $exp = array_sum([1]);
         $this->assertEquals($exp, $res);

         $res = $dice->saveRoundComp();
         $exp = in_array($dice->values);
         $this->assertEquals($exp, $res);

    }


    /**
    * Just assert something is true.
    */
    public function testInitRoundComp()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->initRoundComp();
         $exp = null;
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testInitGameComp()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->initGameComp();
         $exp = null;
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testSaveRoundComp()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->saveRoundComp();
         $exp = $dice->sumRound;
         $this->assertEquals($exp, $res);

         $res = $dice->initRoundComp();
         $exp = array_sum([1]);
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetRoundTotalComp()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getRoundTotalComp();
         $exp = 2;
         $this->assertEquals($exp, $res);

         $res = $dice->getRoundTotalComp();
         $exp = 101;
         $this->assertEquals($exp, $res);
    }

    /**
    * Just assert something is true.
    */
    public function testGetSavedTotalComp()
    {
         $dice = new DiceHand();
         $this->assertInstanceOf("\Lihu\Dice\DiceHand", $dice);

         $res = $dice->getSavedTotalComp();
         $exp = 2;
         $this->assertEquals($exp, $res);
    }

}
