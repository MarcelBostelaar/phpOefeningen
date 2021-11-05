<?php
    /**
     * Code that makes the fillable code, the expected answer and the user result
     * */

const FieldPlaceholder = "[FIELD]";

class line{
    const LineBreak = 0;
    const Code = 1;
    const Field = 2;


    public $type;
    public $value;
}

/** Returns a line start for fillable code
 * @param $lineNumber
 * @return string
 */
function lineStart($lineNumber){return "<tr><td>$lineNumber</td><td>";}

/** Returns the html for a fillable code excercise.
 * @param array $lines Array of line objects
 * @param array $solutions Array of the solutions, ordered
 * @param array $userAnswers Array of the user ansers, ordered
 * @return string HTML code for a fillable code excercise, filled in with the solutions and user answers
 */
function invulbareCode(array $lines, array $solutions, array $userAnswers){
    $fieldCounter = 0;
    $lineCounter = 1;

    $totaalHTML = "<table>";

    $totaalHTML .= lineStart($lineCounter);
    $lineCounter++;

    foreach ($lines as $i){
        switch($i->type){
            case line::LineBreak:
                $totaalHTML .= "</td></tr>" . lineStart($lineCounter);
                $lineCounter++;
                break;
            case line::Code:
                $totaalHTML .= "<p class='code inline'>$i->value</p>";
                break;
            case line::Field:
                $totaalHTML .= "<input type='text' oninput='fieldInput()' name='field_$fieldCounter' class='field' value='$userAnswers[$fieldCounter]'/>
                    <input type='text' class='fieldSolution' value='$solutions[$fieldCounter]' readonly/>";
                $fieldCounter++;
                break;
        }
    }
    $totaalHTML .= "</td></tr></table>";
    return $totaalHTML;
}

/**
 * @param $someString string Single line to parse
 * @return array of line objects
 */
function parseSingleLine($someString){
    $field = new line();
    $field->type = line::Field;
    $makeCodeStruct = function ($code){
        $i = new line();
        $i->type = line::Code;
        $i->value = $code;
        return $i;
    };
    $split = array_map($makeCodeStruct, explode(FieldPlaceholder, $someString));
    return interleaveArray($split, $field);
}