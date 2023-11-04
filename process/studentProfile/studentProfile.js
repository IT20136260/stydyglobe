//search profile
function studentIdForStudentProfile(id) {
    var rootDir = window.location.origin;
    window.location = rootDir + "/view/studentProfile.php?id=" + id;
}

//amount discount total
function setTotal(element) {
    document.getElementById("paymentTotal").value = element.value;
}
function setDiscount(element) {
    let amount = document.getElementById("paymentAmount").value;
    let discount = element.value;
    let discountAmount = (amount * discount) / 100;
    let total = amount - discountAmount;

    document.getElementById("paymentTotal").value = total;
}

//payment proof image
function paymentProofimage() {
    var image = document.getElementById("paymentProof");

    image.onchange = function () {
        var file_count = image.files.length;
        document.getElementById("paymentProofCount").innerText = file_count;
    };
}

//invoice print
function paymentInvoice(id) {

    const amount = document.getElementById("paymentAmount").value;
    const dicount = document.getElementById("paymentDiscount").value;
    const total = document.getElementById("paymentTotal").value;
    const dis = document.getElementById("paymentDescription").value;
    const payType = document.getElementById("paymentType").value;
    const paymentProof = document.getElementById("paymentProof").files;

    if (amount !== "" && !isNaN(amount) && payType !== "") {
        //create new form
        const form = new FormData();
        form.append("studentId", id);
        form.append("paymentAmount", amount);
        form.append("dicount", dicount);
        form.append("paymentTotal", total);
        form.append("paymentDescription", dis);
        form.append("paymentType", payType);

        if (paymentProof.length == 1) {
            for (let i = 0; i < paymentProof.length; i++) {
                const file = paymentProof[i];
                form.append('proof[]', file);
            }
        }

        var rootDir = window.location.origin;
        fetch(rootDir + '/process/studentProfile/studentProfile.pro.php', {
            method: "POST",
            body: form,
        })
            .then((response) => {
                //return response.text();
                return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
            })
            .then((data) => {
                //console.log(data)
                if(data.isPost){
                    alert("Data is added. click ok to make invoice !");
                    var rootDir = window.location.origin;
                    window.location = rootDir + "/view/invoice.php?id=" + data.invoiceId;
                }else{
                    alert("Somthing went wrong ! Please try again.");
                }
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        alert("Please Enter Valied amount and payment type ")
    }
}


function printStudentInvoice(id){
    window.location = "./fullInvoice.php?id="+id;
}