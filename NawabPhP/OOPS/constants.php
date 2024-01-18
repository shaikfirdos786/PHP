<?php
/*
class Goodbye{
    const LEAVING_MESSAGE = "Hi iam Nawab! How are you?";
}

echo Goodbye::LEAVING_MESSAGE;
*/

// using self keyword
class Goodbye{
    const LEAVING_MESSAGE = "Hi iam Nawab! How are you? Tell me: ";
    function byebye(){
        echo self::LEAVING_MESSAGE;
    }
}

$goodbye = new Goodbye();
$goodbye->byebye();

?>