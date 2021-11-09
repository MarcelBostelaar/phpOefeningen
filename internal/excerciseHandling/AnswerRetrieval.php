<?php

/**
 * @param $fieldCount int amount of fields to retrieve
 * @return array<string> Array of user answers;
 */
function GetUserSetFields(int $fieldCount){
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

/**
 * @return bool Whether or not user answers were send at all.
 */
function WereUserAnswersSend(){
    if(!isset($_POST["submit"])) {
        return false;
    }
    return true;
}

