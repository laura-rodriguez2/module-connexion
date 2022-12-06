function validateEmail() {
    var user_email = document.getElementById("email").value;
    var user2_email = document.getElementById("email");
    var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (re.test(user_email)) {
        user2_email.style.border = "grey solid 3px";
        return true;
    }
    else {
        user2_email.style.border = "red solid 3px";
        alert("Veuillez rentrer une adresse email valide");
        return false;
        
    }
}


// Selecting button element
var btn = document.getElementById("bouton_inscri");
var btn = document.getElementById("bouton_inscri_inscription");

// Assigning event listeners to the button
btn.addEventListener("click", validateEmail);
btn.addEventListener("click", validateAdress);
