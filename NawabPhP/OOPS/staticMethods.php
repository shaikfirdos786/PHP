<?php
/*
class greeting{
    public static function welcome(){
        echo "Hello World";
    }
}

greeting::welcome();
*/

/*
class wish{
    public static function greet(){
        echo "Hello How are you.";
    }

    public function __construct()
    {
        self::greet();
    }
}

new wish();
*/

/*
class A{
    public static function welcome(){
        echo "Hi, Iam Nawab.";
    }
}

class B{
    public function message(){
        A::welcome();
    }
}

$obj = new B();
$obj->message();
*/

class domain{
    protected static function getWebsiteName(){
        return "NawabLovesZinat.com";
    }
}

class domainZ extends domain{
    public $webSiteName;
    public function __construct()
    {
        $this->webSiteName = parent::getWebsiteName();
    }
}

$dom = new domainZ();
echo $dom->webSiteName;
?>