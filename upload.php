
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
    $_SESSION['checkbox1'] = (isset($_POST['checkbox1'])) ? $_POST['checkbox1'] : "";
    $klantID = $_SESSION["gekozen_klant"];
    $dir= $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/morres-marketing-tool/upload/';



    $facebook1=$_FILES['facebook1']['name'];
    $temp_name1=$_FILES['facebook1']['tmp_name'];

    $facebook2=$_FILES['facebook2']['name'];
    $temp_name2=$_FILES['facebook2']['tmp_name'];

    $linkedin1=$_FILES['linkedin1']['name'];
    $temp_name3=$_FILES['linkedin1']['tmp_name'];

    $linkedin2=$_FILES['linkedin2']['name'];
    $temp_name4=$_FILES['linkedin2']['tmp_name'];



    //$Linkedin=$_FILES['Linkedin']['name'];
    //var_dump($_FILES['uploadfile']);

      //facebook 1
      if($facebook1!=""){
          if(file_exists($dir.$facebook1))
          {
              $facebook1= $facebook1;
          }
          $_SESSION['fbuploaded1'] = "true";
          $fdir= $dir.$facebook1;
          move_uploaded_file($temp_name1, $fdir);
      }

      //facebook 2
      if($facebook2!=""){
          if(file_exists($dir.$facebook2))
          {
              $facebook2= $facebook2;
          }
          $_SESSION['fbuploaded2'] = "true";
          $fdir= $dir.$facebook2;
          move_uploaded_file($temp_name2, $fdir);
      }      

      //linkedin 1
      if($linkedin1!=""){
          if(file_exists($dir.$linkedin1))
          {
              $linkedin1= $linkedin1;
          }
          $_SESSION['liuploaded1'] = "true";
          $fdir= $dir.$linkedin1;
          move_uploaded_file($temp_name3, $fdir);
      }           

      //linkedin 2
      if($linkedin2!=""){
          if(file_exists($dir.$linkedin2))
          {
              $linkedin2= $linkedin2;
          }
          $_SESSION['liuploaded2'] = "true";
          $fdir= $dir.$linkedin2;
          move_uploaded_file($temp_name4, $fdir);
      }         



         $query1  = "UPDATE rpprt_klanten SET klant_fb_file1 = '$facebook1' WHERE ID= '$klantID'  ";
         $query2  = "UPDATE rpprt_klanten SET klant_fb_file2 = '$facebook2' WHERE ID= '$klantID'  ";
         $query3  = "UPDATE rpprt_klanten SET klant_linkedin_file1 = '$linkedin1' WHERE ID= '$klantID'  ";
         $query4  = "UPDATE rpprt_klanten SET klant_linkedin_file2 = '$linkedin2' WHERE ID= '$klantID'  ";
 
         mysqli_query($db,$query1) or die(mysqli_error($db));
         mysqli_query($db,$query2) or die(mysqli_error($db));
         mysqli_query($db,$query3) or die(mysqli_error($db));
         mysqli_query($db,$query4) or die(mysqli_error($db));
           
        // echo "Files Uploaded Successfully ";
}

?>       




<META HTTP-EQUIV="refresh" CONTENT="0.1;URL=?pagina=overzicht">

























