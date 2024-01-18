<?php
/*
trait message1{
    public function msg1(){
        echo "Hello World!<br>";
    }
}

class Welcome{
    use message1;
}

$obj = new Welcome();
$obj->msg1();
*/

/* using multiple traits
trait message1
{
    public function msg1()
    {
        echo "Hello World!<br>";
    }
}

trait message2
{
    public function msg2()
    {
        echo "Iam no one...<br>";
    }
}

class Welcome
{
    use message1, message2;
}

$obj = new Welcome();
$obj->msg1();
$obj->msg2();
*/

// Method Conflict Resolution
trait message1
{
    public function msg1()
    {
        echo "Hello World!<br>";
    }
}

trait message2
{
    public function msg1()
    {
        echo "Iam no one...<br>";
        echo "conflict solved.<br>";
    }
}

class Welcome
{
    use message1, message2{
        message1::msg1 insteadOf message2;
        message2::msg1 as msg2;
    }
}

$obj = new Welcome();
$obj->msg1();
$obj->msg2();

?>