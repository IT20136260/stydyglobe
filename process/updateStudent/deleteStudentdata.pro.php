<?php
session_start();
require_once("../dataValidate.func.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/connection.php');

$isPost = false;
$isUserExists = false;

if($_SERVER["REQUEST_METHOD"] === "GET" && $_GET["id"]){

    $studentId = $_GET["id"];
    $isPost = true;

    $check_userData_rs = Database::search("SELECT * FROM `studentdata` WHERE `id` = '" . $studentId . "' ");
    $check_userData_num = $check_userData_rs->num_rows;

    if ($check_userData_num == 1) {
        $isUserExists = true;

        //pdf delete
        Database::iud("DELETE FROM studentdata_has_document WHERE studentdata_id = '".$studentId."'");
        Database::iud("DELETE FROM payment WHERE studentdata_id = '".$studentId."'");
        //student delete
        Database::iud("DELETE FROM studentdata WHERE id = '".$studentId."'");
        
    } else {
        $isUserExists = false;
    }
    
}else{
    $isPost = false;
}

//JASON
$data = array(
    "isPost" => $isPost,
    "isUserExists" =>$isUserExists//
);
echo  json_encode($data);
