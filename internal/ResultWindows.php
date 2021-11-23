<?php
include_once dirname(__DIR__) . "/internal/excerciseHandling/CodeExecution.php";

/**
 * Echos an expected and real outcome window set.
 * @param array<line> $parsedLines
 * @param array<string> $realAnswers
 * @param array<string> $userAnswers
 * @param bool $executeUserCode
 */
function ResultWindows($parsedLines, $realAnswers, $userAnswers, $executeUserCode){
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
        if ($executeUserCode) {
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
<?php }

/**
 * Runs the code of the user and example and returns if the results are equal.
 * @param array<line> $parsedLines
 * @param array<string> $realAnswers
 * @param array<string> $userAnswers
 * @return bool
 */
function ResultIsCorrect($parsedLines, $realAnswers, $userAnswers)
{
    $correctResult = RunCodeWithAnswers($parsedLines, $realAnswers);
    $userResult = RunCodeWithAnswers($parsedLines, $userAnswers);
    return $correctResult == $userResult;
}