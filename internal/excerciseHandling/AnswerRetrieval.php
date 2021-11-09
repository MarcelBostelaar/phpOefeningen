<?php

/**
 * @param $fieldCount int amount of fields to retrieve
 * @return array<string>|null Array of answers if any were send, or null is no answers were send
 */
function GetUserSetFields(int $fieldCount){
    if(!isset($_POST["submit"])) {
        return null;
    }

    $values = [];
    for ($i = 0; $i < $fieldCount; $i++){
        if(isset($_POST["field_$i"])){
            array_push($values, $_POST["field_$i"]);
        }
        else{
            array_push($values, ""); //no value found for this field, set empty string
        }
    }
    return $values;
}

