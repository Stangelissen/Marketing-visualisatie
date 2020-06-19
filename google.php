<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php
include ("connect.php");

$db = new mysqli('localhost', $username, $password, $database);
if (!$db) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '
       . mysqli_connect_error());
} 



//echo $_SESSION["klant_mailchimp"] ;  // Displaying Selected Value


echo $_SESSION["klant_google"];

$klantID = $_SESSION["gekozen_klant"];


$api_key = $_SESSION["klant_mailchimp"];
 

?>


<iframe width="900" height="675" src="https://datastudio.google.com/embed/reporting/1UHJe0BvaM_kUQYlAKfghnuxJRu82-yf0/page/7tkE" frameborder="0" style="border:0" allowfullscreen></iframe>

<a href="?pagina=active_demand" class="next">Next</a>