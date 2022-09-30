<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Projet Wikisource sur l'Heptaméron des nouvelles</title>
    <meta name="Description" content="Projet Wikisource">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" 
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" 
          crossorigin="anonymous">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>

		<style>
		    * {
		      margin:0px;
		      padding:0px;
		    }
		    a {
		        color:#ff3333;
		    }
        body {
            font-family: calibri, verdana;
            padding: 20px;
            margin: 0px;
            width: auto;
        }
        .motif-list-control {
            width: 300px;
        }
        .formblock{
            width: 50%
        }
        #choixMotif{
            background-color: #e7e7e7;
            padding: 20px;
            border-radius: 10px;
        }
        .mdl-data-table th  {
            font-size: 14px;
            font-weight: normal;
        }
        #progress-block{
          position: relative;
          display: inline-block;
          background-color: #3d566e;
          margin-bottom:-5px;
          width: 100px;
          height: 20px;
          text-align: center;
        }
        #progress-block-text{
          position: absolute;
          left:0px;
          right:0px;
          text-align: center;
          color: white;
          height: 20px;
          font-size:0.6em;
        }
        #progress-block-decision{
          position: relative;
          display: inline-block;
          background-color: lightgray;
          margin-bottom:-5px;
          width: 100px;
          height: 20px;
          text-align: center;
        }
        #progress-bar{
          position: absolute;
          background-color: rgba(255,255,255,0.5);
          height: 20px;
        }
        #progress-bar-A{
          position: absolute;
          background-color: lightblue;
          height: 20px;
        }
        #progress-bar-B{
          position: absolute;
          background-color: #5a6f84;
          height: 20px;
        }
        #progress-bar-C{
          position: absolute;
          background-color: #ff8181 ;
          height: 20px;
        }
        h2{
          font-size:1.8em;
        }
        h3,p,ul{
          font-size:1.5em;
        }
        li{
          font-size:1.3em;
        }
        p{
          width:90%;
        }
        .page{
          display: inline-block;
          background-color: #DDDDFF;
          border-radius: 10px;
          padding: 10px;
          margin: 10px;
        }
        .pageRelue{
          background-color: #FFDDDD;
          font-size: 0.6em
        }
    </style>
</head>
<body>
<?php

function pageLabel($i){
global $pageDebut;
         $numPage = floor(($i-$pageDebut)/2);
         if($numPage>192){
            $numPage += 2;
         }
         if(($i-$pageDebut)%2==0){
            $numPage .= "r";
         } else {
            $numPage .= "v";
         }
   return $numPage;
}


// Connexion à la base de données
include("connexion.php");

$url = "https://fr.wikisource.org/w/index.php?title=Page:Marguerite_de_Navarre_-_L%27heptam%C3%A9ron_des_nouvelles,_1559.pdf/";
$table = "wikisourceHeptameron";
$pageDebut = 17;
$pageFin = 439;
    
$nom = "";
if(isset($_POST["nom"])){
   $nom = $_POST["nom"];
   $i = $_POST['id'];
   if(strlen($nom)<3){
      echo ('<p style="background-color:#FFBBBB;">Votre choix de la <a href="#nom'.$i.'">page '.$i.'</a> n’a pas été enregistré, avez-vous oublié d’écrire votre nom ?</p>');   
   } else {
      $sql = "SELECT * FROM '.$table.' WHERE `nom`='".$nom."'";
      $req = $link -> prepare($sql);
      $req -> execute();
      //if($req -> rowCount() > 1){
      //   echo ('<p style="background-color:#FFBBBB;">Vous avez déjà choisi 2 pages à relire ! Merci d’attendre le 19 décembre pour en relire d’autres.</p>');   
      //} else {
         $sql = 'INSERT INTO '.$table.' (id, nom, ip) VALUES (:id, :nom, :ip)';
         // On prépare la requête avant l'envoi :
         $req = $link -> prepare($sql);
         $req->bindValue(':id', $_POST['id'], PDO::PARAM_STR);
         $req->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
         $req->bindValue(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
         // On envoie la requête :
         $req -> execute();
         echo ('<p style="background-color:lime;">Merci d’avoir choisi la page '.pageLabel($i).' ! 
         <a href="'.$url.($i).'&action=edit">Cliquez ici</a> pour commencer à la corriger !</p>');
      //}
   }
}
?>

<h1>Projet Wikisource sur l’<i>Heptaméron des nouvelles</i> de Marguerite de Navarre</h1>
<p>
Pourriez-vous indiquer ci-dessous <b>VOTRE NOM EN MAJUSCULES</b> suivi d’un espace suivi de <b>votre prénom</b> dans le cadre de texte correspondant à chaque page sur laquelle vous avez choisi de travailler, juste avant de commencer à la modifier ?
</p>
<p id="dejaRelu"></p>
<?php
$req = $link->prepare("SELECT id FROM ".$table);
$req -> execute();
/* Récupération de toutes les valeurs de la première colonne */
$allPages = $req -> fetchAll(PDO::FETCH_COLUMN, 0);

$i = $pageDebut+2;
$pagesRelues = 0;
$pages = 0;
while($i < $pageFin){
  $pages++;
  if(in_array("".$i, $allPages)){
     $pagesRelues++;
     echo '  <div class="page pageRelue"><p><a href="'.$url.$i.'">Page '.pageLabel($i).'</a> déjà choisie !</p></div>';
  } else {
     echo '
  <div class="page">
  <form action="index.php" method="POST"> 
  <p><a href="'.$url.$i.'&action=edit">Page '.pageLabel($i).'</a> :</p>
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <label class="mdl-textfield__label" for="nom'.$i.'" value="">NOM Prénom
    </label>
    <input class="mdl-textfield__input" type="text" name="nom" id="nom'.$i.'">
  </div>
  <input type="hidden" name="id" value="'.$i.'"><br>
  <input type="submit" class="mdl-button mdl-js-button mdl-button--raised" value="Choisir la page '.pageLabel($i).' !">
  </form>
  </div>
  ';
     
  }
  $i ++;
}

echo '
<script>document.querySelector("#dejaRelu").innerHTML = "'.$pagesRelues.' pages déjà relues sur '.$pages.' ('.round($pagesRelues/$pages*100,2).' %)."</script>';
?>
  
</form>
<!--
    Projet Wikisource, v1.2, 2022-09-30
    Choix de page Wikisource à transcrire
    Copyright (C) 2020-2022 - Philippe Gambette

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.

-->
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<SCRIPT TYPE="text/javascript" SRC="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></SCRIPT>
<script TYPE="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script TYPE="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$("#nom").on("change",function(){
   $("#nom1").val($("#nom").val());
   $("#nom2").val($("#nom").val());
})

$("#nom").on("keyup",function(){
   $("#nom1").val($("#nom").val());
   $("#nom2").val($("#nom").val());
})
</script>
<p>Votre nom et votre adresse IP seront conservées pendant 5 ans avant suppression, contactez Philippe Gambette à l'adresse philippe.gambette@univ-eiffel.fr pour exercer votre droit d'accès et de rectification aux données à caractère personnel</p>
</body>
</html>