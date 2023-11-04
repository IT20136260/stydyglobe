<?php require './connection.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>studyglobe student data form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./src/assest/style.css">
</head>

<body style="overflow-x: hidden;">

    <div class="container-fluid">
        <div class="row">

            <nav class="bg-dark py-3">
                <div class="row text-light text-center">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="col-12 col-md-6">
                            <h1><img src="#" class="w-25" alt=""></h1>
                        </div>
                        <div class="col-12 col-md-6">
                            <h3> studyGlobe Student Data Collecting Form</h3>
                        </div>
                    </div>
                </div>
            </nav>

            <p class="text-end m-2 me-3"><span class="text-danger fw-bold">*</span> Fields are mandotory to fill</p>

            <div class="d-flex flex-column flex-lg-row align-items-center">
                <div class="row col-12">

                    <!-- student images -->
                    <div class="col-12 col-md-4 mx-auto ">
                        <div class="row mx-auto">
                            <div class="col-12 d-flex justify-content-center mx-auto">
                                <img src="./src/img/imageBg.png" class="bg-transparent w-75 img-thumbnail border-0 " id="addStudent-img">
                            </div>
                        </div>

                        <!-- image select -->
                        <div class="row my-2 ">
                            <div class="col-12 mt-1 text-center">
                                <input type="file" class="d-none" accept=".jpg, .jpeg, .png" id="addStudent_imageSelect">
                                <label for="addStudent_imageSelect" class="w-75 btn py-2 btn-dark col-12  rounded-0" onclick="addStudentimage()">Add Image</label>
                            </div>
                            <p class="text-secondary text-center mx-auto mt-2">Upload student image (Passport size)</p>
                        </div>

                        <!-- doc select -->
                        <div class="row my-2 ">
                            <div class="col-12 mt-1 text-center">
                                <p class="fw-bold"><span class="text-danger" id="documnet_count">0</span> Document selected</p>
                                <input type="file" class="d-none" multiple accept=".pdf" id="addStudent_docSelect">
                                <label for="addStudent_docSelect" class="w-75 btn py-2 btn-dark col-12  rounded-0" onclick="addStudentDoc()">Add Document</label>
                            </div>
                            <p class="text-secondary text-center mx-auto mt-2">Upload Following Document <br>
                                Birth Certificate (Sinhala & English)  <br>
                                Passport ,<br>
                                O/L Certificate ,<br>
                                A/L Certificate ,<br>
                                Service Letter , <br>
                                Other Certificates
                            </p>
                        </div>

                    </div>

                    <!-- student data form -->
                    <div class="col-12 col-md-8 d-flex flex-column">
                        <div>
                            <h3 class="fw-bold">Personal Details</h3>
                            <div id="alertMsg" class="alert alert-danger d-none" role="alert">
                            </div>

                            <!-- form -->
                            <div class="d-flex flex-column">

                                <!-- name -->
                                <div class="d-flex flex-column flex-md-row justify-content-between my-1">
                                    <div class="d-flex flex-column w-100 me-1">
                                        <label for="">Full name <span class="text-danger ms-1 fw-bold">*</span></label>
                                        <input type="text" class="rounded-pill form-control py-2" id="studentFullName">
                                    </div>
                                </div>

                                <!-- email -->
                                <div class="d-flex flex-column w-100 my-1">
                                    <label for="">E-mail<span class="text-danger ms-1 fw-bold">*</span></label>
                                    <input type="email" class="rounded-pill form-control py-2" id="studentEmail">
                                </div>

                                <!-- nic/passport -->
                                <div class="d-flex flex-column flex-md-row justify-content-between my-1">
                                    <div class="d-flex flex-column w-75 me-1">
                                        <label for="">Nic number<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <input type="text" class="rounded-pill form-control py-2" id="studentNic">
                                    </div>
                                </div>

                                <!-- nic/passport -->
                                <div class="d-flex flex-column flex-md-row justify-content-between my-1">
                                    <div class="d-flex flex-column w-100 me-1">
                                        <label for="">Passport number<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <input type="text" class="rounded-pill form-control py-2" id="studentPassportNumber">
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <label for="">Passport Expire Date <span class="text-danger ms-1 fw-bold">*</span> </label>
                                        <input type="date" class="rounded-pill form-control py-2" id="studentPassportExpireDate">
                                    </div>
                                </div>

                                <!-- gender / Marital  select -->
                                <div class="d-flex flex-column flex-md-row justify-content-between my-3">
                                    <div class="d-flex flex-column w-100 me-1">
                                        <label for="">Gender<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <select class="form-select rounded-pill text-center" id="studentGender">
                                            <option value="" selected disabled>---Select Gender---</option>
                                            <?php
                                            $set_gender_rs = Database::search("SELECT * FROM gender");
                                            while ($set_gender_data = $set_gender_rs->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $set_gender_data["id"] ?>"><?php echo $set_gender_data["gender"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="d-flex flex-column w-100">
                                        <label for="">Marital State<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <select class="form-select rounded-pill text-center" id="studentMaritalState">
                                            <option value="" selected disabled>---Select State---</option>
                                            <?php
                                            $set_marital_rs = Database::search("SELECT * FROM `marital`");
                                            while ($set_marital_data = $set_marital_rs->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $set_marital_data["id"] ?>"><?php echo $set_marital_data["marital"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- rade / religion number -->
                                <div class="d-flex flex-column flex-md-row justify-content-between my-1">
                                    <div class="d-flex flex-column w-100 me-1">
                                        <label for="">Race<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <input type="text" class="rounded-pill form-control py-2" id="studentRace">
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <label for="">Religion<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <input type="text" class="rounded-pill form-control py-2" id="studentReligion">
                                    </div>
                                </div>

                                <div class="d-flex flex-column w-50 me-1">
                                    <label for="">Contact number <span class="text-danger ms-1 fw-bold">*</span></label>
                                    <input type="text" class="rounded-pill form-control py-2" id="studentContactNumber">
                                </div>

                                <!-- Address -->
                                <div class="d-flex flex-column w-100 my-1">
                                    <label for="">Address<span class="text-danger ms-1 fw-bold">*</span></label>
                                    <textarea cols="30" rows="2" class="rounded form-control py-2" id="studentAddress"></textarea>
                                </div>

                                <!-- Parent's details -->
                                <div class="d-flex flex-column flex-md-row justify-content-between my-1">
                                    <div class="d-flex flex-column w-100 me-1">
                                        <label for="">Parent's name <span class="fw-light">(Father/Mother/Other)</span><span class="text-danger ms-1 fw-bold">*</span></label>
                                        <input type="text" class="rounded-pill form-control py-2" id="studentParentName">
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <label for="">Parent's name Contact number <span class="text-danger ms-1 fw-bold">*</span> </label>
                                        <input type="text" class="rounded-pill form-control py-2" id="studentParentContactNumber">
                                    </div>
                                </div>

                                <!-- Extra information -->
                                <div class="d-flex flex-column w-100 my-1">
                                    <label for="">Extra information</label>
                                    <textarea cols="30" rows="2" class="rounded form-control py-2" id="studentExtraInfo" >No</textarea>
                                </div>

                                <div class="mt-5 mb-2">
                                    <h3 class="fw-bold">Abroad Details</h3>
                                </div>

                                <!-- country/university select -->
                                <div class="d-flex flex-column flex-md-row my-2">

                                    <div class="d-flex flex-column w-100 my-1 me-1">
                                        <label for="">Country<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <select class="form-select rounded-pill text-center" id="studentCountry" onchange="uniload(this.value)">
                                            <option value="" selected disabled>---Select country---</option>
                                            <?php
                                            $set_country_rs = Database::search("SELECT * FROM `country`");
                                            while ($set_country_data = $set_country_rs->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $set_country_data["id"] ?>"><?php echo $set_country_data["country"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="d-flex flex-column w-100 my-1">
                                        <label for="">University / College<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <select class="form-select rounded-pill text-center" id="studentUniversity" onchange="programload(this.value)">
                                            <option value="" selected disabled>---Select University---</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Degree program -->
                                <div class="d-flex flex-column w-100 my-2 me-1">
                                    <label for="">Preferd program<span class="text-danger ms-1 fw-bold">*</span></label>
                                    <select class="form-select rounded-pill text-center" id="studentDegree">
                                        <option value="" selected disabled>---Select Degree program---</option>
                                    </select>
                                </div>

                                <!-- level/mode select -->
                                <div class="d-flex flex-column flex-md-row my-2">

                                    <div class="d-flex flex-column w-100 my-1 me-1">
                                        <label for="">Level<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <select class="form-select rounded-pill text-center" id="studentDegreeLevel">
                                            <option value="" selected disabled>---Select level---</option>
                                            <?php
                                            $set_level_rs = Database::search("SELECT * FROM `level`");
                                            while ($set_level_data = $set_level_rs->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $set_level_data["id"] ?>"><?php echo $set_level_data["level"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="d-flex flex-column w-100 my-1">
                                        <label for="">Mode<span class="text-danger ms-1 fw-bold">*</span></label>
                                        <select class="form-select rounded-pill text-center" id="studentMode">
                                            <option value="" selected disabled>---Select Mode---</option>
                                            <?php
                                            $set_mode_rs = Database::search("SELECT * FROM `mode`");
                                            while ($set_mode_data = $set_mode_rs->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $set_mode_data["id"] ?>"><?php echo $set_mode_data["mode"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <!-- add student btn -->
                                <div class="col-12 mx-auto d-flex flex-column justify-content-center my-5" id="studentAddBtnSection">
                                    <button class="btn btn-lg btn-dark rounded-pill mx-5 px-3" onclick="addStudent()">Add my data</button>
                                </div>

                                <div class="col-12 spinnerDiv d-none" id="spin">
                                    <div class="lds-ellipsis">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./process/dataLoad/dataload.js"></script>
        <script src="./process/addStudent/addstudent.js"></script>

</body>

</html>