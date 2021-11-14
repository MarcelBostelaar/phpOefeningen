<?php
include_once dirname(__DIR__) . "/internal/excerciseHandling/CodeExecution.php";

/**
 * Echos an expected and real outcome window set.
 * @param array<line> $parsedLines
 * @param array<string> $realAnswers
 * @param array<string> $userAnswers
 */
function ResultWindows($parsedLines, $realAnswers, $userAnswers){
    ?>
    <h2>Verwachte uitkomst:</h2>
    <div class='examplediv'>
        <?php
        $correctResult = RunCodeWithAnswers($parsedLines, $realAnswers);
        echo $correctResult;
        ?>
    </div>

    <h2>Jouw uitkomst uitkomst:</h2>
        <?php
        if (WereUserAnswersSend()) {
            $userResult = RunCodeWithAnswers($parsedLines, $userAnswers);
            if($userResult == $correctResult)
                echo "<div class='correct solutiondiv'>";
            else
                echo "<div class='incorrect solutiondiv'>";
            echo $userResult;
        } else {
            echo "<div class='incorrect solutiondiv'>";
            echo "Nog geen code uitgevoerd, klik op uitvoeren";
        }
        ?>
    </div>
<?php } ?>