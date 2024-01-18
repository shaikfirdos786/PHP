<?php
/*
using json_encode() function to encode a value to json format
$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
echo json_encode($age);

$cars = array("Volvo", "BMW", "Toyota");
echo json_encode($cars);

using json_decode() to decode a json object into php object or an associate array.
$jsonobj = '{"Peter":35, "Ben":37, "Joe":43}';
var_dump(json_decode($jsonobj));

$jsonobj = '{"Peter":35, "Ben":37, "Joe":43}';
var_dump(json_decode($jsonobj, true));

Accessing the Decoded Values
$jsonobj = '{"Peter":35, "Ben":37, "Joe":43}';
$obj = json_decode($jsonobj);
echo $obj->Peter;
echo "<br>";
echo $obj->Ben;
echo "<br>";
echo $obj->Joe;

$jsonobj = '{"Peter":35, "Ben":37, "Joe":43}';
$arr = json_decode($jsonobj, true);
echo $arr["Peter"];
echo "<br>";
echo $arr["Ben"];
echo "<br>";
echo $arr["Joe"];

using for loop to access decoded values
$jsonobj = '{"Peter":35, "Ben":37, "Joe":43}';
$obj = json_decode($jsonobj);
foreach($obj as $key => $value) {
    echo $key."=>".$value."<br>";
}
*/

$jsonobj = '{"Peter":35, "Ben":37, "Joe":43}';
$arr = json_decode($jsonobj, true);
foreach ($arr as $key => $value) {
    echo $key . " => " . $value . "<br>";
}

?>