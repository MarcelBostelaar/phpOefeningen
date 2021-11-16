<?php
    /**
     * Code that makes the fillable code, the expected answer and the user result
     * */

include_once dirname(__DIR__) . "/util/classes.php";

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
                $code = $i->value;
                $code = htmlspecialchars($code);
                $code = str_replace(" ", "&nbsp", $code);
                $totaalHTML .= "<p>$code</p>";
                break;
            case line::Field:
                $fieldsizeUser = strlen($userAnswers[$fieldCounter]) / 10 * 10 + 10;
                $fieldsizeAnswer = strlen($solutions[$fieldCounter]) / 10 * 10 + 10;
                $fieldsizeUser = $fieldsizeUser < 20 ? 20 : $fieldsizeUser;
                $fieldsizeAnswer = $fieldsizeAnswer < 20 ? 20 : $fieldsizeAnswer;
                $totaalHTML .= "<input type='text' oninput='fieldInput()' name='field_$fieldCounter' class='fieldAnswer' value='$userAnswers[$fieldCounter]' size='$fieldsizeUser'/>
                    <input type='text' class='fieldSolution' value='$solutions[$fieldCounter]' readonly size='$fieldsizeAnswer'/>";
                $fieldCounter++;
                break;
        }
    }
    $totaalHTML .= "</td></tr></table>";
    return $totaalHTML;
}