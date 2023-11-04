<?php
//data trim
function input_data_validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//check user is exists
function isUserExists($uname, $pass){

    $check_user_exists_rs = Database::search("SELECT `username` , `password` FROM user WHERE username = '".$uname."' ");
    
    if ($check_user_exists_rs->num_rows == 1) {
        $check_user_exists_data = $check_user_exists_rs->fetch_assoc();

        if (password_verify($pass, $check_user_exists_data["password"])) {
            return true;
        }else{
            return false;
        }
    } else {
        return false;
    }
}

//student name validation
function validateName($name){
    $minLength = 10;
    $maxLength = 500;
    $nameLength = strlen($name);

    if ($nameLength < $minLength || $nameLength > $maxLength) {
        return "Name must be between $minLength and $maxLength characters long.";
    } elseif (!preg_match('/^[A-Za-z\s.\-]+$/u', $name)) {
        return "Name can only contain letters, spaces, periods, and hyphens.";
    } else {
        return "";
    }
}

//email validation
function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    } else {
        return "";
    }
}

//nic validate
function validateNIC($nic){
    if (!preg_match("/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/", $nic)) {
        return "Invalid NIC format.";
    } else {
        return "";
    }
}

//passport number validation
function validatePassportNumber($passportNumber){
    if (!preg_match("/^[A-Z0-9]{6,20}$/i", $passportNumber)) {
        return "Invalid passport number format.";
    } else {
        return "";
    }
}

//student contactNumber validate
function validateMobile($contactNumber){
    if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $contactNumber)) {
        return "Invalid mobile number format.";
    }elseif(strlen($contactNumber) !== 10){
        return "Invalid mobile number format.";
    } else {
        return "";
    }
}