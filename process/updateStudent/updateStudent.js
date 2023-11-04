//set data for update
function studentIdForUpdate(id) {

    var rootDir = window.location.origin;
    fetch(rootDir + '/process/updateStudent/studentDataSetForUpdate.pro.php?id=' + id, {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
            console.log(data);

            if (data.isGetSet && data.isIdVal) {
                //get input data
                const idArray = [
                    "studentFullName",
                    "studentEmail",
                    "studentNic",
                    "studentPassportNumber",
                    "studentPassportExpireDate",
                    "studentGender",
                    "studentMaritalState",
                    "studentRace",
                    "studentReligion",
                    "studentContactNumber",
                    "studentAddress",
                    "studentParentName",
                    "studentParentContactNumber",
                    "studentExtraInfo",
                    "studentCountry",
                    "studentUniversity",
                    "studentDegree",
                    "studentDegreeLevel",
                    "studentMode" //19
                ];
                //set Id data
                idArray.forEach(elementId => {
                    const elementValue = document.getElementById(elementId).value;
                });

                studentFullName.value = data.studentData.name;
                studentEmail.value = data.studentData.email;
                studentNic.value = data.studentData.nic;
                studentPassportNumber.value = data.studentData.passportnumber;
                studentPassportExpireDate.value = data.studentData.passport_exday;
                studentGender.value = data.studentData.gender_id;
                studentMaritalState.value = data.studentData.marital_id;
                studentRace.value = data.studentData.race;
                studentReligion.value = data.studentData.religion;
                studentContactNumber.value = data.studentData.student_contact;
                studentAddress.value = data.studentData.address;
                studentParentName.value = data.studentData.pname;
                studentParentContactNumber.value = data.studentData.pcontact;
                studentExtraInfo.value = data.studentData.einformation;
                studentCountry.value = data.studentData.country_id;

                uniloadUp(data.studentData.country_id, data.studentData.university_id);
                programloadUp(data.studentData.university_id, data.studentData.program_id);

                studentDegreeLevel.value = data.studentData.level_id;
                studentMode.value = data.studentData.mode_id;
                document.getElementById("addStudent-img").src = "../document/img/" + data.studentData.imagepath;
                document.getElementById("documnet_count").innerHTML = data.fileCount;

            } else {
                alert("Somthing went wrong.please try again !")
            }


        })
        .catch((error) => {
            console.log(error);
        });
}

//uni and programm data load
function uniloadUp(val, uniID) {
    var rootDir = window.location.origin;

    fetch(rootDir + '/process/dataLoad/uniload.pro.php?id=' + val, {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
            if (data.isIdSet) {

                var unidata = data.uniData;
                var selectElement = document.getElementById('studentUniversity');
                selectElement.innerHTML = '<option value="null" selected disabled>---Select University---</option>';

                unidata.forEach(function (university) {
                    var option = document.createElement('option');
                    option.value = university.id;
                    option.textContent = university.university;
                    selectElement.appendChild(option);

                    if (university.id == uniID) {
                        option.selected = true;
                    }
                });

            } else {
                alert("Somthing went wong !")
            }
            // console.log(data)
        })
        .catch((error) => {
            console.log(error);
        });

}

function programloadUp(val, proId) {
    var rootDir = window.location.origin;

    fetch(rootDir + '/process/dataLoad/programload.pro.php?id=' + val, {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
            if (data.isIdSet) {

                var prodata = data.proData;
                var selectElement = document.getElementById('studentDegree');
                selectElement.innerHTML = '<option value="null" selected disabled>---Select Program---</option>';

                prodata.forEach(function (program) {
                    var option = document.createElement('option');
                    option.value = program.id;
                    option.textContent = program.program;
                    selectElement.appendChild(option);

                    if (program.id == proId) {
                        option.selected = true;
                    }
                });

            } else {
                alert("Somthing went wong !")
            }
            // console.log(data)
        })
        .catch((error) => {
            console.log(error);
        });
}

function UpdateStudent() {
    const id = document.getElementById("selectedStudent").value;
    const name = document.getElementById("studentFullName").value;
    const email = document.getElementById("studentEmail").value;
    const nic = document.getElementById("studentNic").value;
    const passport = document.getElementById("studentPassportNumber").value;
    const passport_ex_date = document.getElementById("studentPassportExpireDate").value;
    const gender = document.getElementById("studentGender").value;
    const marital = document.getElementById("studentMaritalState").value;
    const race = document.getElementById("studentRace").value;
    const religion = document.getElementById("studentReligion").value;
    const contactNumber = document.getElementById("studentContactNumber").value;
    const address = document.getElementById("studentAddress").value;
    const pName = document.getElementById("studentParentName").value;
    const pContact = document.getElementById("studentParentContactNumber").value;
    const ex_info = document.getElementById("studentExtraInfo").value;
    const country = document.getElementById("studentCountry").value;
    const uni = document.getElementById("studentUniversity").value;
    const program = document.getElementById("studentDegree").value;
    const level = document.getElementById("studentDegreeLevel").value;
    const mode = document.getElementById("studentMode").value;

    //get image and pdf
    const img = document.getElementById("addStudent_imageSelect").files;
    const pdf = document.getElementById("addStudent_docSelect");
    var pdfArray = [];
    var files = pdf.files;
    for (var x = 0; x < files.length; x++) {
        pdfArray.push(files[x]);
    }

    const form = new FormData();

    form.append('studentFullName', name);
    form.append('studentEmail', email);
    form.append('studentNic', nic);
    form.append('studentPassportNumber', passport);
    form.append('studentPassportExpireDate', passport_ex_date);
    form.append('studentGender', gender);
    form.append('studentMaritalState', marital);
    form.append('studentRace', race);
    form.append('studentReligion', religion);
    form.append('studentContactNumber', contactNumber);
    form.append('studentAddress', address);
    form.append('studentParentName', pName);
    form.append('studentParentContactNumber', pContact);
    form.append('studentExtraInfo', ex_info);
    form.append('studentCountry', country);
    form.append('studentUniversity', uni);
    form.append('studentDegree', program);
    form.append('studentDegreeLevel', level);
    form.append('studentMode', mode);

    for (let i = 0; i < img.length; i++) {
        const file = img[i];
        form.append('images[]', file);
    }
    for (var i = 0; i < pdfArray.length; i++) {
        form.append('doc[]', pdfArray[i]);
    }

    var rootDir = window.location.origin;
    fetch(rootDir + '/process/updateStudent/updateStudentdata.pro.php?id=' + id, {
        method: "POST",
        body: form,
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
            if (data.isPost) {
                //req field warning
                var emptyFields = data.reqFields;
                if (emptyFields.length < 1) {
                    var validateError = data.dataValidation;
                    if (validateError.length < 1) {
                        if (data.isUserExists) {
                            alert("Your data is Uploading ! (it's take few time to upload the file. don't close the window)")
                            var btn = document.getElementById("studentUDbtnSection");
                            var spinner = document.getElementById("spin");
                            btn.classList.add("d-none");
                            spinner.classList.remove("d-none");

                            setTimeout(function () {
                                alert("Your data is uploded , Thank you !");
                                location.reload();
                            }, 30000);

                        } else {
                            alert("You Are Already Exists")
                        }
                    } else {
                        for (var fieldId in validateError) {
                            if (validateError.hasOwnProperty(fieldId)) {
                                document.getElementById(fieldId).style.border = "2px solid #FE8B73";
                                alert(validateError[fieldId]);
                            }
                        }
                    }
                } else {
                    for (let i = 0; i < emptyFields.length; i++) {
                        document.getElementById(emptyFields[i]).style.border = "2px solid #FE8B73";
                    }
                }
            } else {
                alert("Somthing went wrong ! please try again ")
            }
            console.log(data)
        })
        .catch((error) => {
            console.log(error);
        });
}


function deleteStudent() {
    const isConfirmed = window.confirm("Are you sure you want to delete this data?");

    if (isConfirmed) {
        const id = document.getElementById("selectedStudent").value;

        var rootDir = window.location.origin;
        fetch(rootDir + '/process/updateStudent/deleteStudentdata.pro.php?id=' + id, {
            method: "GET",
        })
            .then((response) => {
                //return response.text();
                return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
            })
            .then((data) => {
                if (data.isPost) {
                    if (data.isUserExists) {
                        alert("Your data is Deleting ! (it's take few time to Deleting the file. don't close the window)")
                        var btn = document.getElementById("studentUDbtnSection");
                        var spinner = document.getElementById("spin");
                        btn.classList.add("d-none");
                        spinner.classList.remove("d-none");

                        setTimeout(function () {
                            alert("Data has been deleted.");
                            location.reload();
                        }, 2000);
                    } else {
                        alert("Somthing went wrong ! please try again ")
                    }
                } else {
                    alert("Somthing went wrong ! please try again ")
                }
                //console.log(data)
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        alert("Data deletion canceled.");
    }

}
