function uniload(val){
    var rootDir = window.location.origin;
    
    fetch(rootDir+'/process/dataLoad/uniload.pro.php?id='+val, {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
          if(data.isIdSet){
            
            var unidata = data.uniData;
            var selectElement = document.getElementById('studentUniversity');
            selectElement.innerHTML = '<option value="null" selected disabled>---Select University---</option>';

            unidata.forEach(function (university) {
                var option = document.createElement('option');
                option.value = university.id; 
                option.textContent = university.university;
                selectElement.appendChild(option);
            });

          }else{
            alert("Somthing went wong !")
          }
        //console.log(data)
        })
        .catch((error) => {
            console.log(error);
        });

}

function programload(val){
  var rootDir = window.location.origin;

    fetch(rootDir+'/process/dataLoad/programload.pro.php?id='+val, {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
          if(data.isIdSet){
            
            var prodata = data.proData;
            var selectElement = document.getElementById('studentDegree');
            selectElement.innerHTML = '<option value="null" selected disabled>---Select Program---</option>';

            prodata.forEach(function (program) {
                var option = document.createElement('option');
                option.value = program.id; 
                option.textContent = program.program;
                selectElement.appendChild(option);
            });

          }else{
            alert("Somthing went wong !")
          }
        // console.log(data)
        })
        .catch((error) => {
            console.log(error);
        });
}