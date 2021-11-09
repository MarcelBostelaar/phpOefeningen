<?php

include "../util/configAndConstants.php";
include "../util/classes.php";
include "../util/util.php";


/**
 * @param $stringToParse string Single line of excercise code to parse
 * @return array<line>
 */
function parseSingleLine(string $stringToParse){
    $field = line::field();
    $makeCodeStruct = function ($code){
        return line::code($code);
    };
    $splitLine = array_map($makeCodeStruct, explode(FieldPlaceholder, $stringToParse));
    return interleaveArray($splitLine, $field);
}

/**
 * @param $quotedCode string the code to parse
 * @return array<line>
 */
function ParseFullExcercise(string $quotedCode){
    $linebreak = line::linebreak();

    $quotedCode = str_replace("\r\n", "\n", $quotedCode);
    $quotedCode = htmlspecialchars($quotedCode);
    $quotedCode = str_replace(" ", "&nbsp", $quotedCode);
    $quotedCodeArray = explode("\n", $quotedCode); //splits on linebreaks

    $arrayOfLines = array_map("parseSingleLine", $quotedCodeArray);
    $interleavedLinebreak = interleaveArray($arrayOfLines, [$linebreak]);

    return flatten($interleavedLinebreak);
}