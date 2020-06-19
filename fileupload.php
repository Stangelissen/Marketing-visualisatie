<?php

include ("connect.php");
?>

<?php

$db = new mysqli('localhost', $username, $password, $database);
if (!$db) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '
       . mysqli_connect_error());

} 

if(isset($_POST['submit'])){
                     $_SESSION["gekozen_klant"] = $_POST['klant_id'];  // Storing Selected Value In Variable
                   //  echo "You have selected :" . $_SESSION["klant_naam"];  // Displaying Selected Value
        } 

$result = mysqli_query($db,"SELECT * FROM rpprt_klanten WHERE ID = ". $_POST['klant_id'] ."");

            while($row = mysqli_fetch_array($result)) {
            echo "<div class='titelblok'> <h2 class='klantentitel'> " . $row['klant_naam'] . "</h2> </div>";  

            } 

?>


<div class="titelblok"> 
    <p>Upload data</p>
</div>


<div class="formwrap">

    <form method="POST" action="?pagina=upload2" enctype="multipart/form-data">

        <?php 
             
                 if(isset($_POST['submit'])){
                     $_SESSION["gekozen_klant"] = $_POST['klant_id'];  // Storing Selected Value In Variable
                    // $_SESSION["klant_naam"] = $_POST['klant_naam'];
                    // echo "You have selected :" . $_SESSION["gekozen_klant"];  // Displaying Selected Value
        } 



             $result = mysqli_query($db,"SELECT * FROM rpprt_klanten WHERE ID = ". $_POST['klant_id'] ."");

             while($row = mysqli_fetch_array($result)) {

                


                echo "<div class='form_element'> ";
                    echo "<label for='facebook' class='form_label'> Facebook </div>";
                echo "<div id='hidediv'> <input type='file' name='facebook_xls1' id='facebook1'></label>  <br>";
                echo " <input type='file' name='facebook_xls2' id='facebook2'></label>  </div><br>";    


                echo "<div class='form_element'> ";
                    echo "<label for='linkedin' class='form_label'> LinkedIn </div>";
                echo "<div id='hidediv2'> <input type='file' name='linkedin_xls1' id='linkedin1'></label>  <br>";
                echo " <input type='file' name='linkedin_xls2' id='linkedin2'></label>  </div><br>";                        


//                echo "<input type='checkbox' value='" . $row['klant_mailchimp'] . "'>" . "Mailchimp" . "<br>";
                $_SESSION["klant_mailchimp"] = $row['klant_mailchimp'];
                $_SESSION["klant_naam"] = $row['klant_naam'];
                //echo $_SESSION["klant_naam"];

            }?> 


            <div class="knop">
                <input type="submit" name="submit" value="Volgende"> 
            </div>

    </form>

</div>









