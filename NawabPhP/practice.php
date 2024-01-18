<?php
/*
$number = 21474836476987;
echo "<h1>Iam Nawab $number</h1>";
echo "<br>";
$x = true;
$y = false;
print var_dump($x);
echo "<br>";
print var_dump($y);
echo "<br>";
*/
?>


<?php
/*
$age = 67;
if($age > 25 && $age < 65) {
    echo "you can drive";
}
elseif($age > 65) {
    echo "you cannot drive.";
}
elseif($age < 25){
    echo "you cannot drive.";
}
*/
?>


<?php

$num1 = 23;
$num2 = 2;

function greatestNum($a, $b)
{
    if ($a > $b) {
        return $a;
    } else {
        return $b;
    }
}

$Max = greatestNum($num1, $num2);

echo "The Maximum number is: $Max <br>";

?>


<?php

$names = array("Firdos", "loves", "Zinat");

foreach ($names as $value) {
    echo "$value <br>";
}
echo strlen("FirdosLovesZinat");
echo "<br>";
echo str_word_count("Firdos Loves Zinat");
echo "<br>";
echo strpos("Firdos Loves Zinat", "Zinat");
echo "<br>";
echo rand(1, 100);
?>

<?php
$str = "Visit W3Schools";
$pattern = "/w3schools/i";
echo "<br>";
echo preg_match($pattern, $str);
?>