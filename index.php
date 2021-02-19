<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=tuto;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<!-- le script qui va nous permettre dafficher le formulaire au chargement de la page -->
<script>
                window.onload = function(){setTimeout(function(){document.getElementById("mainCont").style.display = "block";}, 2500);}
        </script>


<main class="container-fluid centers">
        
        <div class="row">
            <div class="conteneur1"  id="mainCont">
            <h2><b>Formulaire d'enregistrement</b></h2>

<form action="index.php" method="post" style="margin: 20px;">
       
        <!-- traitement du formulaire en php-->
        <?php

if(isset($_POST['enregistrer'])){

    // on commence par  enregistrer les entree utilisateur
    $nom = trim(htmlspecialchars($_POST['nom'])) ;
    $prenom = trim(htmlspecialchars($_POST['prenom']));
    $telephone = trim(htmlspecialchars($_POST['telephone']));
    $messages = trim(htmlspecialchars($_POST['messages']));
    $success = ' <div class="alert alert-success" role="alert" style="height: 50px;width:350px;margin:30px;">
                    <p>vos donées ont bien éte enregistrer</p>
                 </div>';
    $error = '<div class="alert alert-danger" role="alert" style="height: 50px;width:350px;margin:30px;">
                    <p>veuillez remplir le formulaire s\'il vous plait</p>
              </div>';

                // on prepare une requete pour envoyer les informations dans la base de donnees
    $req = $bdd->prepare('INSERT INTO form(nom, prenom, telephone, messages) VALUES(:nom, :prenom, :telephone, :messages)');
    
    if($nom AND $prenom AND $telephone AND $messages = true){
    
        // on execute la requete
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'telephone' => $telephone,
            'messages' => $messages
        ));
?>
<?php
//on affiche ce message si les donnees ont ete envoyer
 echo $success;  
}

// sinon on affiche le message
else{
    echo $error;
}
}
else{
    echo'';
};
?>

    <img src="image.jpg" alt="image" height="200px" width="100%" style="margin-bottom: 5px;"><br>

        <label><b>NOM</b></label>
            <br>
        <input type="text" name="nom" id="nom">
            <br>
        <label><b>PRENOM</b></label>
            <br>
        <input type="text" name="prenom" id="prenom">
            <br>
        <label><b>NUMERO</b></label>
            <br>
        <input type="tel" name="telephone" id="telephone">
            <br>
        <label><b>MESSAGE</b></label>
            <br>
        <textarea name="messages" id="messages" cols="30" rows="3"></textarea>
            <br>
            <br>
        <input type="submit" value="enregistrer" name="enregistrer" class="btn btn-success">
    </form>


            </div>
       
        </div>
</main>


</body>
</html>