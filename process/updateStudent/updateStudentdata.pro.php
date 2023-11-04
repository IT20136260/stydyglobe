<?php
session_start();
require_once("../dataValidate.func.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/connection.php');

$isPost = false;
$dataValidation  = array();
$reqFields = array();
$isUserExists = false;

if($_SERVER["REQUEST_METHOD"] === "POST" && $_GET["id"]){

    $studentId = $_GET["id"];

    $isPost = true;

    function getEmptyFields() {
        $emptyFields = [];
    
        // Fields that can be empty
        $optionalFields = ['images[]', 'doc[]'];
    
        foreach ($_POST as $key => $value) {
            // Skip optional fields
            if(in_array($key, $optionalFields)){continue;}
            if(empty($value)){$emptyFields[] = $key;}
        }
    
        return $emptyFields;
    }
    
    // Usage
    $emptyFields = getEmptyFields();
    
    if (empty($emptyFields)) {
        
        //date validation
        $name =  input_data_validate($_POST["studentFullName"]);
        $email =  input_data_validate($_POST["studentEmail"]);
        $nic =  input_data_validate($_POST["studentNic"]);
        $passport =  input_data_validate($_POST["studentPassportNumber"]);
        $passport_ex_date =  input_data_validate($_POST["studentPassportExpireDate"]);
        $gender =  input_data_validate($_POST["studentGender"]);
        $marital =  input_data_validate($_POST["studentMaritalState"]);
        $race =  input_data_validate($_POST["studentRace"]);
        $religion =  input_data_validate($_POST["studentReligion"]);
        $contactNumber =  input_data_validate($_POST["studentContactNumber"]);
        $address =  input_data_validate($_POST["studentAddress"]);
        $pName =  input_data_validate($_POST["studentParentName"]);
        $pContact =  input_data_validate($_POST["studentParentContactNumber"]);
        $ex_info =  input_data_validate($_POST["studentExtraInfo"]);
        $country =  input_data_validate($_POST["studentCountry"]);
        $uni =  input_data_validate($_POST["studentUniversity"]);
        $program =  input_data_validate($_POST["studentDegree"]);
        $level =  input_data_validate($_POST["studentDegreeLevel"]);
        $mode =  input_data_validate($_POST["studentMode"]);


        $validationErrors = [];
        if (!empty(validateName($name))){$validationErrors['studentFullName'] = validateName($name);}
        if (!empty(validateName($pName))){$validationErrors['studentParentName'] = validateName($pName);}
        if (!empty(validateEmail($email))){$validationErrors['studentEmail'] = validateEmail($email);}
        if (!empty(validateNIC($nic))){$validationErrors['studentNic'] = validateNIC($nic);}
        if (!empty(validatePassportNumber($passport))){$validationErrors['studentPassportNumber'] = validatePassportNumber($passport);}
        if (!empty(validateMobile($contactNumber))){$validationErrors['studentContactNumber'] = validateMobile($contactNumber);}
        if (!empty(validateMobile($pContact))){$validationErrors['studentParentContactNumber'] = validateMobile($pContact);}

        if (empty($validationErrors)) {

            $check_userData_rs = Database::search("SELECT * FROM `studentdata` WHERE `id` = '" . $studentId . "' ");
            $check_userData_num = $check_userData_rs->num_rows;

            if ($check_userData_num == 1) {
                $isUserExists = true;
                //add image name
                if (isset($_FILES['images'])) {
                    $images = $_FILES['images'];
                    $filetype = "img";
                    foreach ($images['tmp_name'] as $key => $tmpName) {
                        $imageExtension = pathinfo($images['name'][$key], PATHINFO_EXTENSION);
                        $uniqueID = uniqid();
                        $imageName = $filetype . '_' . $uniqueID . '.' . $imageExtension;
                        move_uploaded_file($tmpName, '../../document/img/' . $imageName);
                    }

                    Database::iud("UPDATE `studentdata` SET
                                `imagepath` = '$imageName'
                                WHERE `id` = '$studentId' ");
                }

                Database::iud("UPDATE `studentdata` SET
                `name` = '".$name."',
                `email` = '".$email."',
                `nic` = '".$nic."',
                `passportnumber` = '".$passport."',
                `passport_exday` = '".$passport_ex_date."',
                `race` = '".$race."',
                `religion` = '".$religion."',
                `student_contact` = '".$contactNumber."',
                `address` = '".$address."',
                `pname` = '".$pName."',
                `pcontact` = '".$pContact."',
                `einformation` = '".$ex_info."',
                `gender_id` = '".$gender."',
                `marital_id` = '".$marital."',
                `country_id` = '".$country."',
                `university_id` = '".$uni."',
                `program_id` = '".$program."',
                `level_id` = '".$level."',
                `mode_id` = '".$mode."'
                 WHERE `id` = '".$studentId."' ");


                // add doc
                if (isset($_FILES['doc'])) {
                    $doc = $_FILES['doc'];
                    foreach ($doc['tmp_name'] as $key => $tmpName) {
                        $docExtension = pathinfo($doc['name'][$key], PATHINFO_EXTENSION);
                        $uniqueID = uniqid();
                        $docName = $studentId . '_' . $uniqueID . '.' . $docExtension;
                        move_uploaded_file($tmpName, '../../document/doc/' . $docName);

                        Database::iud("INSERT INTO document(`path`) VALUE ('" . $docName . "')");
                        $docId = Database::$connection->insert_id;
                        Database::iud("INSERT INTO studentdata_has_document(`studentdata_id`,`document_id`) VALUE ('" . $studentId . "','" . $docId . "')");
                    }
                }
            } else {
                $isUserExists = false;
            }
        } else {
            $dataValidation = $validationErrors;
        }
    }else{
        $reqFields = $emptyFields;
    }
}else{
    $isPost = false;
}

//JASON
$data = array(
    "isPost" => $isPost,
    "reqFields" => $reqFields,
    "dataValidation" => $dataValidation,
    "isUserExists" =>$isUserExists//
);
echo  json_encode($data);
