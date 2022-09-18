<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Carnel</title>
    <link rel="icon" href="carnellogo.png">
  </head>

    <?php
    if (isset($_SESSION['User'])) {
    echo 'Bonjour ' . $_SESSION['User'];
}
else {
    echo "Vous êtes déconnecté";
    $redirect_page = 'connexion.php';
    header('Location:'  .$redirect_page);
}

     ?>

     <br></br>

     <form class="test" action="add.php" method="post">
       <label for="movtyp">Type de déplacement</label>
       <input type="text" name="movtyp" id="movtyp" required>
       <br>

       <label for="participation">Participation</label>
       <input type="text" name="participation" id="participation" required>
       <br>

       <label for="mov">Motif du déplacement</label>
       <input type="text" name="mov" id="mov" required>
       <br>

       <label for="debh">Heure de départ</label>
       <input type="number" name="debh" id="debm" min=0 max=23 required>

       <label for="debm">h</label>
       <input type="number" name="debm" id="debm" min=0 max=59 required>
       <br>

       <label for="Ville1">Ville de départ</label>
       <input type="text" name="Ville1" id="Ville1" required>
       <br>
       <label for="Ville2">Ville d'arrivée</label>
       <input type="text" name="Ville2" id="Ville2" required>
       <br>
       <label for="Etape1">Etape1</label>
       <input type="text" name="Etape1" id="Etape1">
       <br>
       <label for="Etape2">Etape2</label>
       <input type="text" name="Etape2" id="Etape2">
       <br>
       <label for="Etape3">Etape3</label>
       <input type="text" name="Etape3" id="Etape3">
       <br>

       <input type="submit" name="Chercher" value="Chercher">
     </form>

     <?php
     $servername = "localhost";//on créé la connexion avec la base de données
     $username = "zgeorge";
     $password = 'ZA12*$za';
     $dbname = "zgeorge_03";
     // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

     $sql2 ='SELECT ID FROM security WHERE Login="'.$_SESSION["User"].'";';

     $result2 = $conn->query($sql2);
     if ($result2->num_rows > 0) {
       while($row = mysqli_fetch_assoc($result2)){
           $id=$row['ID'];
           echo "Mon ID est ".$id;
         }
     }else {
         echo "Empty Data";
     }
     /////////////////////////
     $sql3 ='SELECT Registration FROM vehicle WHERE ID="'.$id.'";';

     $result3 = $conn->query($sql3);
     if ($result3->num_rows > 0) {
       while($row = mysqli_fetch_assoc($result3)){
           $plaque=$row['Registration'];
           echo "Ma plaque est ".$plaque;
         }
     } else {
         echo "Empty Data";
     }
     // Create connection
     /*
     $conn = mysqli_connect($servername, $username, $password, $dbname);
     if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
     }
     */

     $sql="INSERT INTO movement(MovementType,NumPeople,Participation,MovePurpose,Registration,IDTeam1,IDTeam2,IDTeam3,IDTeam4,BegHour,CityBeg,CityEnd,Step1,Step2,Step) VALUES ";

     if (!empty($_POST['movtyp'])){
        $sql.="(".$_POST['movtyp'].",";
      }
     if (!empty($_POST['participation'])){
        $sql.=",".$_POST['participation'].",";
      }
     if (!empty($_POST['mov'])){
        $sql.=",".$_POST['mov'].",";
      }

     if (!empty($_POST['debh']) and !empty($_POST['debm'])){
         if($_POST['debh']<10){
           $sql.=",".$sql.",0".$_POST['debh'];
         }else{
           $sql.=",".$sql.$_POST['debh'];
         }

      if($_POST['debm']<10){
           $sql.=",".$sql."h0".$_POST['debm'];
      }else{
           $sql.=",".$sql."h".$_POST['debm'];
      }

      if($_POST['debm']<10){
           $sql.=",".$sql."h0".$_POST['debm'];
      }else{
           $sql.=",".$sql."h".$_POST['debm'];
      }

      if (!empty($_POST['Ville1'])){
         $sql.=",".$_POST['Ville1'].",";
      }
if (!empty($_POST['Ville2'])){
         $sql.=",".$_POST['Ville2'].",";
}
       if (!empty($_POST['Etape1'])){
         $sql.=",".$_POST['Etape1'].",";
}
       if (!empty($_POST['Etape2'])){
         $sql.=",".$_POST['Etape2'].",";
}
       if (!empty($_POST['Etape3'])){
         $sql.=",".$_POST['Etape3'].",";
}


     }


     $sql=$sql.";";

     echo $sql;
/*
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
             echo "Mark for: " . $row["Name"]. " = " . $row["Mark"]. "<br>";
         }
     } else {
         echo "Empty Data";
     }

*/
     mysqli_close($conn);
     ?>
  </body>
</html>
