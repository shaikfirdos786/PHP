<?php
// function string_length($str) {
//     return strlen($str);
// }
// $string = ["Nawab", "Firdos", "Zinat", "Raza"];
// $result = array_map("string_length", $string);
// print_r($result);

// Using Anonymous function as callback function

// $string = ["Nawab", "Firdos", "Zinat", "Raza"];
// $result = array_map(function($str){ return strlen($str); }, $string);
// echo "Using anonymous function<br>";
// print_r($result);

// User defined functions

function exclaim($str) {
    return $str."!<br>";
}

function ask($str) {
    return $str."?";
}

function printFormatted($str, $format) {
    echo $format($str);
}

printFormatted("Hello World", "exclaim");
printFormatted("Hello World", "ask");
?>