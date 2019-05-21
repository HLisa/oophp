<?php

namespace Lihu\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $response = $this->app->response;
        // Deal with the action and return a response.
        return $response->redirect("dice1/init");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!!";
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        $response = $this->app->response;

        // Init the game.
        $dice = new DiceHand();
        return $response->redirect("dice1/play");

        $this->app->session->set("dice", $dice);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {
        $title = "Play the game";
        $page = $this->app->page;
        $session = $this->app->session;

        // Player
        $values = $session->get("values", null);
        $res = $session->get("res", null);
        $sumRound = $session->get("sumRound", null);
        $sumTotal = $session->get("sumTotal", null);

        //Comp
        $valuesComp = $session->get("valuesComp", null);
        $resComp = $session->get("resComp", null);
        $sumRoundComp = $session->get("sumRoundComp", null);
        $sumTotalComp = $session->get("sumTotalComp", null);

        $session->set("res", null);
        $session->set("resComp", null);
        $session->set("values", null);
        $session->set("valuesComp", null);
        $session->set("reset", null);
        $session->set("comp", null);
        $session->set("sumTotal", null);
        $session->set("sumTotalComp", null);

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

        $page->add("dice1/play", $data);
        // $this->app->page->add("dice1/debug");

        return $page->render([
            "title" => $title,
        ]);

    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionPost() : object
    {
        $response = $this->app->response;
        $session = $this->app->session;

        // Deal with incoming variables.
        $dice = $_SESSION["dice"];
        // $session->set("dice", $dice);

        $dice = $_SESSION["dice"] ?? null;
        $roll = $_POST["roll"] ?? null;
        $save = $_POST["save"] ?? null;
        $reset = $_POST["reset"] ?? null;
        $comp = $_POST["comp"] ?? null;

        // ANVÄND DETTA
        // $roll = $request->getPost("roll", null);
        // $save = $request->getPost("save", null);
        // $reset = $request->getPost("reset", null);
        // $comp = $request->getPost("comp", null);

        // ANVÄND DETTA
        // // Player
        // $values = $session->get("values", null);
        // $sumRound = $session->get("sumRound", null);
        // $sumTotal = $session->get("sumTotal", null);
        // $res = null;
        //
        // //Comp
        // $valuesComp = $session->get("valuesComp", null);
        // $sumRoundComp = $session->get("sumRoundComp", null);
        // $sumTotalComp = $session->get("sumTotalComp", null);
        // $resComp = null;


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

            // $values = $dice->getValues();
            // $sumRound = $dice->getSumRound();
            // $sumRound = $session->get("dice", $dice)->getRoundTotal();
            // $session->set("values", $values);
            // $session->set("sumRound", $sumRound);
            // $session->set("res", $res);
        }

        if (isset($_POST['reset'])) {
            // $app->response->redirect("dice/init");
            // $session->get("dice", $dice)->initGame();
            $_SESSION["dice"]->initGame();
        }

        if (isset($_POST['save'])) {
            // Player
            $_SESSION["dice"]->saveRound();
            $sumTotal = $_SESSION["dice"]->getSavedTotal();
            $_SESSION["sumTotal"] = $sumTotal;
            $_SESSION["res"] = $res;

            // $session->get("dice", $dice)->saveRound();
            // $sumTotal = $session->get("dice", $dice)->getSavedTotal();
            // $session->set("sumTotal", $sumTotal);
            // $session->set("res", $res);

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

            // $valuesComp = $dice->getValuesOne();
            // $sumRoundComp = $dice->getSumRoundComp();
            // $sumRoundComp = $dice->getRoundTotalComp();
            // $session->get("dice", $dice)->saveRoundComp();
            // $sumTotalComp = $session->get("dice", $dice)->getSavedTotalComp();
            // $session->set("valuesComp", $valuesComp);
            // $session->set("sumRoundComp", $sumRoundComp);
            // $session->set("resComp", $resComp);
            // $session->set("sumTotalComp", $sumTotalComp);
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
        return $response->redirect("dice1/play");
}

}
