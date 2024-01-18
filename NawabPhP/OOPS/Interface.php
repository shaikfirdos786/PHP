<?php
interface Animal{
    public function makeSound();
}

class Cat implements Animal{
    public function makeSound()
    {
        echo "Meow<br>";
    }

    public function sleep()
    {
        echo "cat is sleeping.";
    }

}

$animal = new Cat();
$animal->makeSound();
$animal->sleep();

/* 
interface Employee{
    public function work();
}

class Labour{
    public function timing()
    {
        echo "I work for 12 hours daily.";
    }
}

class Hire extends Labour implements Employee{
    public function work()
    {
        echo "You have work for 3 days.";
    }

    public function dedication()
    {
        echo "You must completely dedicated to the work.";
    }
}

$employee = new Hire();
$employee->work();
$employee->timing();
$employee->dedication();
*/


?>