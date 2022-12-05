// VERIFICATIONS DEVIS 
function validateTel() {

    var user_tel = document.getElementById("tel").value;
    var user2_tel = document.getElementById("tel");
    var re = /^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/;


    if (re.test(user_tel)) {
        user2_tel.style.border = "grey solid 3px";
        return true;
    }
    else {

        user2_tel.style.border = "red solid 3px";
        alert("Veuillez rentrer un numéro de téléphone valide");
        return false;
    }
}


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

function validateAdress(){
    var user_adresse = document.getElementById("adresse").value;
    var user2_adresse = document.getElementById("adresse");
    var re = /[0-9]{1,3}(?:(?:[,. ]){1}[-a-zA-Zàâäéèêëïîôöùûüç]+)+/;
    if (re.test(user_adresse)) {
        user2_adresse.style.border = "grey solid 3px";
        return true;
    }
    else {
        user2_adresse.style.border = "red solid 3px";
        alert("Veuillez rentrer une adresse et code postal valide");
        return false;
        
    }
}


// POUR FAIRE PLUSIEURS VERIFICATIONS SUR LE MEME FORMULAIRE

// Selecting button element
var btn = document.getElementById("bouton_inscri");
var btn = document.getElementById("bouton_inscri_inscription");

// Assigning event listeners to the button
btn.addEventListener("click", validateTel);
btn.addEventListener("click", validateEmail);
btn.addEventListener("click", validateAdress);
