<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>



<?php

    include ("connect.php");

    $db = new mysqli('localhost', $username, $password, $database);
    if (!$db) {
      exit('Connect Error (' . mysqli_connect_errno() . ') '
           . mysqli_connect_error());
    } 
?>



<div class="titelblok">
    <h2 class="klantentitel">Klanten</h2>
</div>

<div class="titelblok"> 
    <p>Kies een klant</p>
</div>






<form id="klantenform" class="klantenform" method="POST" action="?pagina=fileupload">
     <select class="form-control" name="klant_id">

        <option value = "">---Select---</option>
         
         <?php 
         $result = mysqli_query($db,"SELECT * FROM rpprt_klanten");

         while($row = mysqli_fetch_array($result)) 
             echo "<option value='" . $row['ID'] . "'>" . $row['klant_naam'] . "</option>";
         //var_dump($row);
         $_SESSION["klant_naam"] = $row['klant_naam'];
         ?>
     </select>
     
</form>

<div class="knop">
<input class="volgendeknop" form="klantenform" type="submit" name="submit" value="Volgende"> 
</div>


</body>
</html>





















