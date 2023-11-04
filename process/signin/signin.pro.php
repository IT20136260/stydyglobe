<?php
session_start();
require_once("../dataValidate.func.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/connection.php');

$isSetData = false;
$isUserExists = false;

if(isset($_POST["uname"]) && isset($_POST["pass"])){
    $isSetData = true;

    $uname = input_data_validate($_POST["uname"]);
    $pass = $_POST["pass"];

    if(isUserExists($uname,$pass)){
        $isUserExists = true;

        //session
        $check_use_added_rs = Database::search("SELECT * FROM user WHERE username = '".$uname."'");
        $check_use_added_data = $check_use_added_rs->fetch_assoc();
        $_SESSION["user"] = $check_use_added_data;

    }else{
        $isUserExists = false;
    }

}else{
    $isSetData = false;
    $isUserExists = false;
}

//JASON
$data = array(
    "isSetData" => $isSetData,
    "isUserExists" => $isUserExists,
);
echo  json_encode($data);

?>