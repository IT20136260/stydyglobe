function userSignIn() {
    const uname = document.getElementById("userName").value;
    const pass = document.getElementById("userPassword").value;

    function isUsernameValid(username) {
        const regex = /^[a-zA-Z0-9]{4,}$/;
        return regex.test(username);
    }

    function isPasswordValid(password) {
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{5,}$/;
        return regex.test(password);
    }

    // Perform validation
    if (!isUsernameValid(uname)) {
        alert("Username is invalid. It should be at least 4 characters long and contain only letters and numbers.");
    } else if (!isPasswordValid(pass)) {
        alert("Password is invalid. It should be at least 5 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
    } else {

        const form = new FormData();

        form.append('uname', uname);
        form.append('pass', pass);

        fetch('../process/signin/signin.pro.php', {
            method: "POST",
            body: form,
        })
            .then((response) => {
                //return response.text();
                return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
            })
            .then((data) => {
                //console.log(data)
                data.isSetData ? data.isUserExists ? location.href = './dashboard.php' : alert("incorrect user name or password.check and try again !") : alert("Somthing went wrong. please try again !");
            })
            .catch((error) => {
                console.log(error);
            });
    }

}

