<?php
include "./excerciseHandling/FillableCodeGenerator.php";
include "./excerciseHandling/AnswerRetrieval.php";
include "./excerciseHandling/CodeExecution.php";
include "./excerciseHandling/ExcerciseParser.php";
?>

<h2>Vul de juiste code in:</h2>
<form method='POST'>
    <?  ?>
    <br><br>
    <input type='submit' value='Test jouw code' name='submit'>
    <br><br>
    <label>
        <input type='checkbox' onchange='toggleExample(this)'>
        <label>Zie oplossing</label>
    </label>
</form>

<h2>Verwachte uitkomst:</h2>
<div class='examplediv'>
<!--execute real solution-->
</div>

<h2>Jouw uitkomst uitkomst:</h2>
<div class='incorrect solutiondiv'>
<!--Eval user solution-->
</div>

