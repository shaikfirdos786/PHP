<?php
class Employee{
    public $name;
    public $id;

    function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    function display(){
        echo "My name is: $this->name <br>";
        echo "My id number is: $this->id <br>";
    }
}

class Department extends Employee{
    public $dept;

    function __construct($name, $id, $dept)
    {
        $this->name = $name;
        $this->id = $id;
        $this->dept = $dept;
    }

    function show(){
        $this->display();
        echo "I work in: $this->dept <br>";
    }
}

$obj = new Department("Firdos", 35, "CS");
$obj->show();


?>