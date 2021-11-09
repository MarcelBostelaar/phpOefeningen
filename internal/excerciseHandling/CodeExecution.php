<?php
include "../util/classes.php";
include "../util/util.php";

/**
 * Takes an array of lines and answers, and creates a string of working code.
 *
 * @param array<line> $lines
 * @param array<string> $solutions
 * @return string
 */
function linesToWorkingCode(array $lines, array $solutions){
    $total = "";
    $counter = 0;

    foreach ($lines as $lineInstance){
        switch($lineInstance){
            case line::LineBreak:
                $total .= "\n";
                break;
            case line::Code:
                $total .= $lineInstance->value;
                break;
            case line::Field:
                $total .= $solutions[$counter];
                $counter++;
                break;
        }
    }
    return $total;
}


/**
 *  * Executes a piece of arbitrary quoted code with arbitrary values (decently) safely.
 *
 * @param array<line> $lines A piece of parsed code
 * @param array<string> $answers The answers to fill into the parsed code
 * @return Closure Anonymous function that, when run, does a new, clean run of the users code.
 */
function CreateRunnableUserCode(array $lines, array $answers){
    return function() use($lines, $answers)
    {
        /*
         * Adds namespace with a unique id around the code, and encapsulates the code in a callable function,
         * to prevent re-declaration of functions, both globally and by repeated exercise execution. Because function declarations are always global.
         * namespace evalNamespace12345{function runEvalUserCode(){ <code here> \n}}
         *
         * Executed by calling evalNamespace12345\runEvalUserCode();
         * */
        $lines = array_merge(
            [line::code('namespace evalNamespace'), line::field(), line::code('{function runEvalUserCode(){')],
            $lines,
            [line::code("\n }}")]);
        $UID = getNewSessionID();
        $answers = appendHead($UID, $answers);
        $finishedCode = linesToWorkingCode($lines, $answers);

        eval($finishedCode); //run code that generates the functions in working memory
        eval("evalNamespace$UID\\runEvalUserCode();"); //execute generated function, which executes user code
    };
}
