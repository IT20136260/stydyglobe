<?php
 require_once($_SERVER['DOCUMENT_ROOT'] . '/connection.php');

 if(isset($_GET["id"])){
    $isIdSet = true;

    $uniData_rs = Database::search("SELECT university.id , university.university 
                                    FROM country_has_university INNER JOIN university ON
                                    country_has_university.university_id = university.id 
                                    WHERE country_id = '".$_GET["id"]."' ");
    
    $uniData_data = array();
    while ($row = $uniData_rs->fetch_assoc()) {
        $uniData_data[] = $row;
    }

 }else{
    $isIdSet = false;
    $uniData_data = null;
 }

  //JASON
  $data = array(
      "isIdSet" => $isIdSet,
      "uniData" => $uniData_data
  );
  
  echo json_encode($data);

?>