<?php

include "./configAndConstants.php";
include "./classes.php";


/**
 * @param $stringToParse string Single line of excercise code to parse
 * @return array<line>
 */
function parseSingleLine($stringToParse){
    $field = line::field();
    $makeCodeStruct = function ($code){
        return line::code($code);
    };
    $splitLine = array_map($makeCodeStruct, explode(FieldPlaceholder, $stringToParse));
    return interleaveArray($splitLine, $field);
}