<?php
abstract class ParentClass
{
    // Abstract method with an argument
    abstract protected function prefixName($name);
}

class ChildClass extends ParentClass
{
    public function prefixName($name)
    {
        if ($name == "Nawab") {
            $prefix = "Mr.";
        } elseif ($name == "Anu") {
            $prefix = "Mrs.";
        } else {
            $prefix = "";
        }
        return "{$prefix} {$name}";
    }
}

$class = new ChildClass;
echo $class->prefixName("Nawab");
echo "<br>";
echo $class->prefixName("Anu");
?>