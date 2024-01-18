<?php
/*
class pi{
    public static $value = 3.14159;
}
echo pi::$value;
*/

/*
class pi{
    public static $value = 3.14159;
    public function getValue(){
        echo "Value: ".self::$value;
    }
}
$pi = new pi();
$pi->getValue();
*/

/*
class A{
    public static $value = 3.14159;
}
class B{
    public function __construct()
    {
        echo A::$value;
    }
}
$obj = new B();
*/


class pi{
    public static $value = 3.14159;
}
class X extends pi{
    public function returnValue(){
        echo "Value: ".parent::$value;
    }
}
$obj = new X();
$obj->returnValue();

?>