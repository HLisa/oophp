<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<h1>Tärningsspelet 100</h1>
<p>Kasta tärningarna och försök att nå 100 poäng innan datorn. Spara dina poäng eller slå täringarna igen. Slår du en etta förlorar du dina poäng och turen går över till datorn. </p>

<?php if ($sumTotal) : ?>
    <p><?= $sumTotal ?> </p>
    <!-- <p><?= implode(", ", $valuesComp) ?></p>
    <p><?= $sumRoundComp ?> </p> -->
    <p><?= $sumTotalComp ?> </p>
<?php endif ?>

<?php if ($values) : ?>
    <p><?= implode(", ", $values) ?></p>
    <p><?= $sumRound ?> </p>
<?php endif ?>

<form method="post">
    <input type="submit" name="roll" value="Slå tärningarna">
    <input type="submit" name="save" value="Spara poäng">
    <input type="submit" name="comp" value="Datorns tur">
    <input type="submit" name="reset" value="Börja om">
</form>

<!-- <pre>
SESSION
<?=var_dump($_SESSION); ?>
POST
<?=var_dump($_POST); ?>
</pre> -->
