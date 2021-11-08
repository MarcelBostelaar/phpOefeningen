<?php
    /**
     * Code that makes the fillable code, the expected answer and the user result
     * */

include "./classes.php";

/** Returns a line start for fillable code
 * @param $lineNumber
 * @return string
 */
function lineStart($lineNumber){return "<tr><td>$lineNumber</td><td>";}

/** Returns the html for a fillable code excercise.
 * @param array<line> $lines Array of line objects
 * @param array<string> $solutions Array of the solutions, ordered
 * @param array<string> $userAnswers Array of the user ansers, ordered
 * @return string HTML code for a fillable code excercise, filled in with the solutions and user answers
 */
function LinesToCodeHTML(array $lines, array $solutions, array $userAnswers){
    $fieldCounter = 0;
    $lineCounter = 1;

    $totaalHTML = "<table class='codeTable'>";

    $totaalHTML .= lineStart($lineCounter);
    $lineCounter++;

    foreach ($lines as $i){
        switch($i->type){
            case line::LineBreak:
                $totaalHTML .= "</td></tr>" . lineStart($lineCounter);
                $lineCounter++;
                break;
            case line::Code:
                $totaalHTML .= "<p>$i->value</p>";
                break;
            case line::Field:
                $totaalHTML .= "<input type='text' oninput='fieldInput()' name='field_$fieldCounter' class='fieldAnswer' value='$userAnswers[$fieldCounter]'/>
                    <input type='text' class='fieldSolution' value='$solutions[$fieldCounter]' readonly/>";
                $fieldCounter++;
                break;
        }
    }
    $totaalHTML .= "</td></tr></table>";
    return $totaalHTML;
}