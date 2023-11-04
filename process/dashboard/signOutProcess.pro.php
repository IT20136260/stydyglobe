<?php
 session_start();

$isLogout = false;

if(isset($_SESSION["user"])){
    $_SESSION["user"] = null;
    session_destroy();
    $isLogout = true;
}

//set data
$data = array(
    'logout' => $isLogout,
);

$jsonData = json_encode($data);
echo $jsonData;


?>