//student data inser update delete form toggle
function crudStudentdata() {

  //page topic change
  let statusElement = document.getElementById("studentDataProcessType");
  let currentStatus = statusElement.innerText;
  if (currentStatus === "Add") {
    statusElement.innerText = "Update/Delete";
  } else if (currentStatus === "Update/Delete") {
    statusElement.innerText = "Add";
  }

  //change btn status
  let btnStatsElemet = document.getElementById("btnStatus");
  let currentbtnStats = btnStatsElemet.innerText;
  if (currentbtnStats === "Update") {
    btnStatsElemet.innerText = "Add";
  } else if (currentbtnStats === "Add") {
    btnStatsElemet.innerText = "Update";
  }


  //student selet tage (for update and delete)
  let studentSelect = document.getElementById("selectStudentForUD");
  studentSelect.classList.toggle("d-none");

  //toggle CRUD btn in addstudent
  let studentAddbtnSection = document.getElementById("studentAddBtnSection");
  studentAddbtnSection.classList.toggle("d-none");

  let studentUDbtnSection = document.getElementById("studentUDbtnSection");
  studentUDbtnSection.classList.toggle("d-none");

}

//add student image
function addStudentimage() {
  var image = document.getElementById("addStudent_imageSelect");

  image.onchange = function () {
    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
      var file = this.files[x];
      var url = window.URL.createObjectURL(file);
      document.getElementById("addStudent-img").src = url;
    }
  };
}

//add direction: 
function addStudentDoc() {
  var pdf = document.getElementById("addStudent_docSelect");

  pdf.onchange = function () {
    var file_count = pdf.files.length;

    if (file_count >= 1) {
      document.getElementById("documnet_count").innerHTML = file_count;
    } else {
      alert("Please select required document.");
    }

  };

}

//add student
function addStudent() {

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
  fetch(rootDir + '/process/addStudent/addStudentdata.pro.php', {
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
            if (data.isUserNotExists) {
              alert("Your data is Uploading ! (it's take few time to upload the file. don't close the window)")
              var btn = document.getElementById("studentAddBtnSection");
              var spinner = document.getElementById("spin");
              btn.classList.add("d-none");
              spinner.classList.remove("d-none");
              
              setTimeout(function() {
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