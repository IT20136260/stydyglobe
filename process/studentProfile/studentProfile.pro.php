<?php
session_start();
require_once("../dataValidate.func.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/connection.php');

//date
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d"); //reg date

$isPost = false;
$invoiceId = "13";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $isPost = true;

    $id = $_POST["studentId"];
    $amount = $_POST["paymentAmount"];
    $discount = $_POST["dicount"];
    $total = $_POST["paymentTotal"];
    $paytype = $_POST["paymentType"];

    if(empty($_POST["paymentDescription"])){
        $description = $_POST["paymentDescription"];
    }else{
        $description = "payment for studyGlobe";
    }

    //proof
    if (isset($_FILES['proof'])) {
        $proof = $_FILES['proof'];
        foreach ($proof['tmp_name'] as $key => $tmpName) {
            $proofExtension = pathinfo($proof['name'][$key], PATHINFO_EXTENSION);
            $uniqueID = uniqid();
            $proofName = $uniqueID . '.' . $proofExtension;
            move_uploaded_file($tmpName, '../../document/payinvoice/' . $proofName);
        }
    }else{
        $proofName = "emptyinvoice.png";
    }

    //add data
    $uniqId = uniqid();
    Database::iud("INSERT INTO`payment` 
    (`studentdata_id`,
     `amount`,
     `discountpr`,
     `discription`,
     `paymenttype_id`,
     `date`,
     `path`,
     `total`,
     `uniqid`) VALUES 
    ( '".$id."',
      '".$amount."',
      '".$discount."',
      '".$description."',
      '".$paytype."',
      '".$date."',
      '".$proofName."',
      '".$total."',
      '".$uniqId."' );");

      $invoiceId =  $id;

}else{
    $isPost = false;
    $invoiceId = "13";
}

//JASON
$data = array(
    "isPost" => $isPost,
    "invoiceId"=>$invoiceId
);
echo  json_encode($data);

?>