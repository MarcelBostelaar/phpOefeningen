<?php
include "util.php";
include "SessionID.php";

class line{
    const LineBreak = 0;
    const Code = 1;
    const Field = 2;


    public $type;
    public $value;
}

function invul(array $lines, array $solutions, array $oldformvalues){
    $fieldCounter = 0;
    $lineCounter = 1;
    echo "
<table>
    <tr>
    <td style='padding-right: 0.5em'>$lineCounter</td>
    <td>";
    foreach ($lines as $i){
        switch($i->type){
            case line::LineBreak:
                $lineCounter++;
                echo "</td></tr>";
                echo "<tr><td>$lineCounter</td><td>";
                break;
            case line::Code:
                echo "<p class='code inline'>$i->value</p>";
                break;
            case line::Field:
                echo "<input type='text' oninput='fieldInput()' name='field_$fieldCounter' class='field' value='$oldformvalues[$fieldCounter]'/>
                    <input type='text' class='fieldSolution' value='$solutions[$fieldCounter]' readonly/>";
                $fieldCounter++;
                break;
        }
    }
    echo "</table>";
}

const FieldPlaceholder = "[FIELD]";
function stringToItems($someString){
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

function parse($quotedCode){
    $linebreak = new line();
    $linebreak->type = line::LineBreak;
    $quotedCode = str_replace("\r\n", "\n", $quotedCode);
    $quotedCode = htmlspecialchars($quotedCode);
    $quotedCode = str_replace(" ", "&nbsp", $quotedCode);
    $quotedCode = explode("\n", $quotedCode);
    $arrayOfLines = array_map("stringToItems", $quotedCode);
    return flatten(interleaveArray($arrayOfLines, [$linebreak]));
}

function printInvulCode($quotedCode, $solutions, $oldformvalues){
    invul(parse($quotedCode), $solutions, $oldformvalues);
}

function replaceFields($quotedCode, array $solutions){
    $quotedCode = "^" . $quotedCode; //done to handle cases where it starts with [FIELD]
    $split = explode(FieldPlaceholder, $quotedCode);
    return substr(implode(zip($split, $solutions)), 1); //remove extra starting char
}

function invulcodeMetForm($quotedCode, $solutions, $oldformvalues){
    echo "<form method='POST'>";
    printInvulCode($quotedCode, $solutions, $oldformvalues);
    echo "<br><br>";
    echo "<br><input type='submit' value='Test jouw code' name='submit'>";
    echo "<br>";
    echo "<br><input type='checkbox' onchange='toggleExample(this)'>Zie oplossing";
    echo "</form>";
}

//gets an array for the form values, or empty value if not found.
function getFormValuesOrEmpty($count){
    $values = [];
    for ($i = 0; $i < $count; $i++){
        if(isset($_POST["field_$i"])){
            array_push($values, $_POST["field_$i"]);
        }
        else{
            array_push($values, "");
        }
    }
    return $values;
}

function runUserCode($quotedCode, $fieldcount){
    if(isset($_POST["submit"])){
        $values = getFormValuesOrEmpty($fieldcount);
        eval(replaceFields($quotedCode, $values));
    }
    else{
        echo 'Nog geen code uitgevoerd. Klik op "Test jouw code" om je code uit te voeren';
    }
}

function getUserSetFields($fieldCount){
    if(isset($_POST["submit"])){
        return getFormValuesOrEmpty($fieldCount);
    }
    else{
        return null;
    }
}

/**
 * Executes a piece of arbitary quoted code with arbitrary values (decently) safely.
 *
 * @param $quotedCode string The code [FIELD] elements in
 * @param array $values The ordered values which are to be inserted into the [FIELD] places.
 */
function evalCodeReal(string $quotedCode, array $values){
    /*
     * Adds namespace with a unique id around the code, and encapsulates the code in a callable function,
     * to prevent re-declaration of functions, both globally and by repeated exercise execution. Because function declarations are always global.
     * */
    $realQuotedCode = 'namespace evalNamespace[FIELD]{function runEvalUserCode(){' . $quotedCode . "\n }}";
    $UID = getNewSessionID();
    $newValues = appendHead($UID, $values);
    //echo replaceFields($quotedCodeWithNamespaceQuote, $exampleFieldsSolution);
    eval(replaceFields($realQuotedCode, $newValues));
    eval("evalNamespace$UID\\runEvalUserCode();");
}

//Creates an excercise. Use "[FIELD]" to insert a text field. Give an array with the/a correct solution for each field. Code should not start with <?php
function createExcercise($quotedCode, array $exampleFieldsSolution){
    echo "<h2>Vul de juiste code in:</h2>";
    invulcodeMetForm($quotedCode, $exampleFieldsSolution, getFormValuesOrEmpty(count($exampleFieldsSolution)));

    echo "<h2>Verwachte uitkomst:</h2>";
    echo "<div style='border-color: black; border-width: 4px; border-style: solid; padding: 1em' id='examplediv'>";
    evalCodeReal($quotedCode, $exampleFieldsSolution);
    echo "</div>";

    echo "<h2>Jouw uitkomst uitkomst:</h2>";
    echo "<div style='border-color: black; border-width: 4px; border-style: solid; padding: 1em' id='solutiondiv' class='incorrect'>";
    $userValues = getUserSetFields(count($exampleFieldsSolution));
    if (is_null($userValues)){
        echo 'Nog geen code uitgevoerd. Klik op "Test jouw code" om je code uit te voeren';
    }
    else{
        evalCodeReal($quotedCode, $userValues);
    }
    echo "</div>";
}
?>