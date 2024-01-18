<?php 
/*
function printIterable(iterable $myIterable){
    foreach($myIterable as $item){
        echo $item;
        echo "<br>";
    }
}
$arr = ["a", "b", "c", "d"];
printIterable($arr);
*/

// using iterable datatype to return array
function getIterable():iterable{
    return ["Firdos ", "Loves ", "Zinat. "];
}
$myIterable = getIterable();
foreach($myIterable as $item){
    echo $item;
}
?>