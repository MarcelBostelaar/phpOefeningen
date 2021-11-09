<?php
//Interleaves the second array into the first one, in a 1-2-1-2 pattern, appending the rest of the remaining array if one is depleted
function zip($array1, $array2){
    $array1 = array_map(function($x){return $x;}, $array1);//shallow opy arrays
    $array2 = array_map(function($x){return $x;}, $array2);
    $result = [];
    while(count($array1) > 0 && count($array2) > 0){
        array_push($result, array_shift($array1));
        array_push($result, array_shift($array2));
    }
    if (count($array1)> 0){
        return array_merge($result, $array1);
    }
    if (count($array2)> 0){
        return array_merge($result, $array2);
    }
    return $result;
}

function interleaveArray($array, $with){
    $step = array_map(function($item)use(&$with){return [$item, $with];}, $array);
    $step = flatten($step);
    array_pop($step);
    return $step;
}

function flatten($arrayOfArrays){
    return array_merge(...$arrayOfArrays);
}

function appendHead($head, $tail){
    $id = function($x){return $x;};
    $i = array_map($id, $tail);
    array_unshift($i, $head);
    return $i;
}

?>





















