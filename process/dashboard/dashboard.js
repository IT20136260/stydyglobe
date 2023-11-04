//signout process
function userSignOut(){
    fetch("../process/dashboard/signOutProcess.pro.php", {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
            if(data.logout){
                window.location = "../../view/index.php";
            }else{
                alert("somthing went wrong !")
            }
        })
        .catch((error) => {
            //console.log(error);
            alert("something went wrong .please try again a few moments");
        });
}

function sendWhatsAppMsg(domain) {
    let number = document.getElementById("studentWhatsappNumber").value;
    let message = `Hello there! 🎓 Ready to embark on your educational journey? We're here to guide you every step of the way. Please take a moment to fill out our form: ${domain}. Achieve your study destination goal with SN Asia 's expert guidance 🌟`;
    let encodedMessage = encodeURIComponent(message);
    window.open(`https://api.whatsapp.com/send?phone=${number}&text=${encodedMessage}`);

    alert("message is send !")
}


