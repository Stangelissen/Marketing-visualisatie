<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php
include ("connect.php");


$db = new mysqli('localhost', $username, $password, $database);
if (!$db) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '
       . mysqli_connect_error());

} 

if(isset($_POST['submit'])){
                    //echo  $_SESSION["gekozen_klant"];   // Storing Selected Value In Variable
                    // echo "You have selected :" . $_SESSION["klant_naam"];  // Displaying Selected Value
        
            echo "<div class='titelblok'> <h2 class='klantentitel'> " . $_SESSION['klant_naam'] . "</h2> </div>";  

            } 

?>


<div class="titelblok"> 
    <p>Selecteer/importeer data</p>
</div>


<div class="formwrap">

    <form method="POST" action="?pagina=upload" enctype="multipart/form-data">

        <?php 
             
                 if(isset($_POST['submit'])){

                   //  $_SESSION["gekozen_klant"] = $_POST['klant_id'];  // Storing Selected Value In Variable
                    // $_SESSION["klant_naam"] = $_POST['klant _naam'];
                   //echo "You have selected :" . $_SESSION["gekozen_klant"];  // Displaying Selected Value
         



             $result = mysqli_query($db,"SELECT * FROM rpprt_klanten WHERE ID = ". $_SESSION['gekozen_klant'] ."");

             while($row = mysqli_fetch_array($result)) {

                echo "<div class='form_element'> ";
                    echo "<label for='checkbox1' class='form_label'> Nieuwsbrieven ";
                echo "<input type='checkbox' id='checkbox1' class='checkbox1' name='checkbox1' value='1' ></label> </div><br>";    
                    $_SESSION["klant_mailchimp"] = $row['klant_mailchimp'];
                    

                    // $_SESSION["checkbox1"] = '1weewfac';
                  



                echo "<div class='form_element'> ";
                    echo "<label for='facebook' class='form_label'> Facebook </div>";
                echo "<div id='hidediv'> <input type='file' name='facebook1' id='facebook1'></label>  <br>";
                echo " <input type='file' name='facebook2' id='facebook2'></label>  </div><br>";    

                if (empty($_FILES['facebook1']['name'])) {
                      $_SESSION['fbuploaded1'] = "false";  // No file was selected for upload, your (re)action goes here
                 } else {
                      $_SESSION['fbuploaded1'] = "true";
                 }

                 if (empty($_FILES['facebook2']['name'])) {
                      $_SESSION['fbuploaded2'] = "false";  // No file was selected for upload, your (re)action goes here
                 } else {
                      $_SESSION['fbuploaded2'] = "true";
                 }




                echo "<div class='form_element'> ";
                    echo "<label for='linkedin' class='form_label'> LinkedIn </div>";
                echo "<div id='hidediv2'> <input type='file' name='linkedin1' id='linkedin1'></label>  <br>";
                echo " <input type='file' name='linkedin2' id='linkedin2'></label>  </div>";                        

                if (empty($_FILES['linkedin1']['name'])) {
                      $_SESSION['liuploaded1'] = "false";  // No file was selected for upload, your (re)action goes here
                 } else {
                      $_SESSION['liuploaded1'] = "true";
                 }

                 if (empty($_FILES['linkedin2']['name'])) {
                      $_SESSION['liuploaded2'] = "false";  // No file was selected for upload, your (re)action goes here
                 } else {
                      $_SESSION['liuploaded2'] = "true";
                 }




               // echo "<input type='checkbox' value='" . $row['klant_mailchimp'] . "'>" . "Mailchimp" . "<br>";
                $_SESSION["klant_mailchimp"] = $row['klant_mailchimp'];
              
            }}?> 

            <div class="knop">


                <input type="submit" name="submit" value="Volgende"> 
            </div>

    </form>

</div>








