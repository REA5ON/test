<?php
session_start();

require "functions.php";


//$email = $_POST["email"];
//$password = $_POST["password"];
//
//
//$login = login($email, $password);
//
//if ($login["email"] == 1 and $login["password"] == 1) {
//    set_flash_message("danger", "Данные введены неверно");
//}
//
//set_flash_message("success", "Авторизация успешна");
//redirect_to("users.php");

$email = "val@mail.ru";
$password = "123";

$login = login($email, $password);
var_dump($login);die;