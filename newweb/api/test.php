<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 18.06.15
 * Time: 12:48
 */

error_reporting(E_ALL);

include("./include/Base.php");

$base = new Base();
echo var_dump($base->getUser(1));