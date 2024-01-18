<?php
require_once 'Namespaces1.php';
require_once 'Namespaces2.php';

use Nawab\User as NawabUser;
use Zinat\User as ZinatUser;

$fiddu = new NawabUser();
$jinnu = new ZinatUser();

$fiddu->sayHello();
$jinnu->sayHello();
?>