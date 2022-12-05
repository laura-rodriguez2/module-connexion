<?php
session_start();
include('../../Back/bdd/bdd.php');
include('../../Back/Utilisateurs.php');

if (isset($_POST['formconnexion'])) {

    $user = new User;
    $userconnect = $user->connexion($_POST['emailconnect'], $_POST['passwordconnect']);
    if ($userconnect == "Vous etes co !") {
        header('location: profil.php');
    } else {
        echo $userconnect;
    }
}

// if (isset($_POST['g_id_onload'])) {

//     $user = new User;
//     $userconnect = $user->connexion($_POST['emailconnect'], $_POST['passwordconnect']);
//     if ($userconnect == "Vous etes co !") {
//         header('location: index.php');
//     } else {
//         echo $userconnect;
//     }
// }

// var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../CSS/connexion.css">
    <link rel="icon" href="../MEDIAS/icon.png">
</head>

<body>
<header>
    <?php
    require('HEADER_FOOTER/header.php');
    ?>
</header>

<main>
    
    <h1 id="title">Se connecter</h1><br>

    <!-- loginconnect remplacé en emailconnect et type=text en type=email -->
    <form id="form_connec" method="POST" action="">

    <img class="img" src="../MEDIAS/Autres/linefeuillev2.png" alt="Banderoles de plantes">

        <div class="connec">
            <p>Email :</p>
            <input type="email" class="box-input" name="emailconnect">
        </div>

        <div class="connec">
            <p>Mot de passe :</p>
            <input type="password" class="text" name="passwordconnect">
        </div>

        <br><input type="submit" id="bouton_co" name="formconnexion" value="Se connecter"><br><br>
        
        <p class="lr_h2">Vous n'avez pas de compte ? <a class="lien_connexion" href="inscription.php">Inscrivez-vous !</a></p>
    </form>


    <!-- TOUT REFAIRE AVEC CE TUTO MEME CREER LAPP  -->
    <!-- https://www.youtube.com/watch?v=gXux8b3wcYw&ab_channel=TraversyMedia  -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
        appId      : '1085931752306113',
      cookie     : true,
      xfbml      : true,
      version    : '{v14.0}'
    });
      
  
FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function statusChangeCallback(response){
        if(response.status === 'connected'){
            console.log('Logged in and authenticated');
        } else {
            console.log('Not authenticated');
        }
   }
</script>


<!-- The JS SDK Login Button -->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<!-- FACEBOOK CONNECT  -->
<!-- 
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{1085931752306113}',
      cookie     : true,
      xfbml      : true,
      version    : '{v14.0}'
    });
      
    // FB.AppEvents.logPageView();   need to be removed
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
function statusChangeCallback(response) {
FB.api('/me?fields=first_name,last_name,email',
 function(response) {
    //   console.log('Successful login for: ' + response.name);
      document.getElementById('name').innerHTML =
      response.first_name + '' +response.last_name;
      document.getElementById('email').innerHTML = response.email;
        document.getElementById('loginBtn').style.display = "none";
        document.getElementById('name').style.display = "block";
        document.getElementById('email').style.display = "block";
        document.getElementById('logoutBtn').style.display = "block";
        // 'Thanks for logging in, ' +
        // response.name + '!';
    });

function logout(response){
        FB.logout(function(response) {
            document.getElementById('loginBtn').style.display = "block";
            document.getElementById('name').style.display = "none";
            document.getElementById('email').style.display = "none";
            document.getElementById('logoutBtn').style.display = "none";
        });
 

}
function fbLogoutUser() {
    FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    });
}


}
</script> -->

            <!-- TUTO FACEBOOK LOGIN LE BOUTON FACEBOOK SAFFICHE PAS  -->
            <!-- https://www.youtube.com/watch?v=5rhT0PLx1rY&ab_channel=MukeshSinghThakur -->

<!-- <div>
    <h2>Login with Facebook</h2>
    
<div id="loginBtn">
    <fb:login-button 
    scope="public_profile,email"
    onlogin="checkLoginState();">
    </fb:login-button>
</div>

    <div id="name"></div>
    <div id="email"></div>
    <br>
    <div id="logoutBtn" onclick="logout()" style="display:none;">LOGOUT</div>
</div>

 -->




 <!-- BOUTON LOGIN IN FACEBOOK -->
 <!-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v14.0&appId=1085931752306113&autoLogAppEvents=1" nonce="jXAQcCog"></script> -->
<!-- <div class="fb-login-button" data-width="200" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="false"></div> -->



<!-- The JS SDK Login Button -->

<!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
 Load the JS SDK asynchronously -->
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>


 --> 




    <!-- <div id="g_id_onload"
     data-client_id="734123724777-fnufv9n0qbmlah0qgvp7nupb9lau1bfe.apps.googleusercontent.com"
     data-context="signin"
     data-login_uri="http://localhost/projectpool3/projetpro/Front/HTML/connexion.php"
     data-auto_select="true">
</div> -->
<!-- 
<form id="form_connec_google" method="POST" action="">
      <script src="https://accounts.google.com/gsi/client" async defer></script>
      <div id="g_id_onload"
         data-client_id="734123724777-fnufv9n0qbmlah0qgvp7nupb9lau1bfe.apps.googleusercontent.com"
         data-login_uri="http://localhost/projectpool3/projetpro/Front/HTML/profil.php"
         data-auto_prompt="false">
      </div>
      <div class="g_id_signin"
         data-type="standard"
         data-size="large"
         data-theme="outline"
         data-text="sign_in_with"
         data-shape="rectangular"
         data-logo_alignment="left">
      </div>
</form> -->
      <!-- <script src="https://accounts.google.com/gsi/client" async defer></script> -->
      <!-- <script>
        function handleCredentialResponse(response) {
          console.log("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: " + response.credential);
        }
        window.onload = function () {
          google.accounts.id.initialize({
            client_id: "734123724777-fnufv9n0qbmlah0qgvp7nupb9lau1bfe.apps.googleusercontent.com", 
            callback: handleCredentialResponse
          });
          google.accounts.id.renderButton(
            document.getElementById("buttonDiv"),
            { theme: "outline", size: "large" }  // customization attributes
          );
          google.accounts.id.prompt(); // also display the One Tap dialog
        }
    </script>
    <div id="buttonDiv"></div>  -->
 


</main>

<footer>
    <?php
    require('HEADER_FOOTER/footer.php');
    ?>
</footer>
</body>

</html>