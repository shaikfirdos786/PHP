<?php
class Destructor{
    public $name;
    public $age;
    public $interest;

    function __construct($name, $age, $interest)
    {
        $this->name = $name;
        $this->age = $age;
        $this->interest = $interest;
    }

    function __destruct()
    {
        echo "<br>I destroyed the object and ran at the end of the script. And the destroyed object was created for $this->name";
    }

    function get_values()
    {
        echo "Name: " . $this->name;
        echo "<br>";
        echo "Age: " . $this->age;
        echo "<br>";
        echo "Interest: " . $this->interest;
    }
}

$obj = new Destructor("Firdos", 21, "Ethical Hacking");
$obj->get_values();
