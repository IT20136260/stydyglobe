<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/connection.php');

$isGetSet = false;
$isIdVal= false;

if(isset($_GET["id"])){
    
    $isGetSet = true;
    $id =  $_GET["id"];

    $check_idIsAvalable_rs = Database::search("SELECT `id` FROM studentdata WHERE `id`='".$id."'");
    $check_idIsAvalable_num = $check_idIsAvalable_rs->num_rows;

    if($check_idIsAvalable_num == 1){
        $get_user_data_rs = Database::search("SELECT * FROM studentdata WHERE `id`='".$id."'");
        $get_user_data_data = $get_user_data_rs->fetch_assoc();

        $get_doc_rs = Database::search("SELECT `id` FROM studentdata_has_document WHERE `studentdata_id`='".$id."' ");
        $get_doc_num = $get_doc_rs->num_rows;

        $isIdVal= true;
    }else{
        $isIdVal= false;
    }
}else{
    $isGetSet = false;
}

$data = array(
    'isGetSet' => $isGetSet,
    'isIdVal' => $isIdVal,
    'studentData' => $get_user_data_data,
    'fileCount' => $get_doc_num  
);

$jsonData = json_encode($data);
echo $jsonData;
