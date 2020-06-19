
<?php
include ("connect.php");

$db = new mysqli('localhost', $username, $password, $database);
if (!$db) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '
       . mysqli_connect_error());
} 

if(isset($_POST['submit'])){
 // Storing Selected Value In Variable
//echo "You have selected :" . $_SESSION["gekozen_klant"] ;  // Displaying Selected Value
//echo "You have selected :" . $_SESSION["klant_active_demand"] ;  // Displaying Selected Value

$klantID = $_SESSION["gekozen_klant"];


    $dir= $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/morres-marketing-tool/upload/';

    $bestand=$_FILES['uploadfile']['name'];
    $temp_name=$_FILES['uploadfile']['tmp_name'];

    $Linkedin=$_FILES['Linkedin']['name'];
    //var_dump($_FILES['uploadfile']);


    if($bestand!="")
    {
        if(file_exists($dir.$bestand))
        {
            $bestand= time().'_'.$bestand;
        }
 
        $fdir= $dir.$bestand;
        move_uploaded_file($temp_name, $fdir);
    }
        
       $query = "UPDATE rpprt_klanten SET klant_mailplus = '$bestand' WHERE ID= '$klantID'  ";
       // $query="insert IGNORE into `rpprt_klanten` (`klant_mailplus`) values ('','$bestand')";
       mysqli_query($db,$query) or die(mysqli_error($db));
         
        echo "File Uploaded Suucessfully ";
 
}

?>       


<a href="?pagina=mailchimp" name="next" class="next">Next</a>























