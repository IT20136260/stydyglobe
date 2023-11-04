<?php
 require_once($_SERVER['DOCUMENT_ROOT'] . '/connection.php');

 if(isset($_GET["id"])){
    $isIdSet = true;

    $proData_rs = Database::search("SELECT program.id ,program.program 
                                    FROM university_has_program INNER JOIN program ON
                                    university_has_program.program_id = program.id 
                                    WHERE university_id = '".$_GET["id"]."' ");
    
    $proData_data = array();
    while ($row = $proData_rs->fetch_assoc()) {
        $proData_data[] = $row;
    }

 }else{
    $isIdSet = false;
    $proData_data = null;
 }

  //JASON
  $data = array(
      "isIdSet" => $isIdSet,
      "proData" => $proData_data
  );
  
  echo json_encode($data);
