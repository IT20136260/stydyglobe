<?php

//connection
require_once('../connection.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../src/assest/style.css">
    
    <title>study globe - <?php echo $title ;?></title>
</head>
<body>
    
<div class="container-fluid">
        <div class="row">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light ">
                <a class="navbar-brand fw-bold h1 mx-5" href="./dashboard.php">studyGlobe</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end mx-5" id="navbarNav">
                    <ul class="navbar-nav ">
                        <li class="nav-item active ">
                            <a class="nav-link text-light" href="./dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="./studentData.php">Add new student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn text-light border border-1 border-light py-1 px-2 rounded-pill mx-3" onclick="userSignOut()"><i class="bi bi-box-arrow-in-right"></i> sign out</a>
                        </li>
                    </ul>
                </div>
            </nav>