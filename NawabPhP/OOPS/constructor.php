<?php
class Constructor{
    public $name;
    public $age;
    public $interest;

    function __construct($name, $age, $interest){
        $this->name = $name;
        $this->age = $age;
        $this->interest = $interest;
    }

    function get_values(){
        echo "Name: ".$this->name;
        echo "<br>";
        echo "Age: ".$this->age;
        echo "<br>";
        echo "Interest: ".$this->interest;
    }
    }

    $obj = new Constructor("Firdos", 21, "Ethical Hacking");
    $obj->get_values();
