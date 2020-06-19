<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
</head>


<?php

include ("connect.php");

$db = new mysqli('localhost', $username, $password, $database);
if (!$db) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '
       . mysqli_connect_error());
} 



if(isset($_POST['submit'])){
 // Storing Selected Value In Variable

// echo "You have selected :" . $_SESSION["gekozen_klant"] ;  // Displaying Selected Value
// echo "You have selected :" . $_SESSION["klant_naam"] ;  // Displaying Selected Value

    $klantID = $_SESSION["gekozen_klant"];
    $dir= $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/morres-marketing-tool/upload/';



    $facebook_xls1=$_FILES['facebook_xls1']['name'];
    $temp_name1=$_FILES['facebook_xls1']['tmp_name'];

    $facebook_xls2=$_FILES['facebook_xls2']['name'];
    $temp_name2=$_FILES['facebook_xls2']['tmp_name'];

    $linkedin_xls1=$_FILES['linkedin_xls1']['name'];
    $temp_name3=$_FILES['linkedin_xls1']['tmp_name'];

    $linkedin_xls2=$_FILES['linkedin_xls2']['name'];
    $temp_name4=$_FILES['linkedin_xls2']['tmp_name'];

    //$Linkedin=$_FILES['Linkedin']['name'];
    //var_dump($_FILES['uploadfile']);

      //facebook 1
      if($facebook_xls1!=""){
          if(file_exists($dir.$facebook_xls1))
          {
              $facebook_xls1= $facebook_xls1;
          }
   
          $fdir= $dir.$facebook_xls1;
          move_uploaded_file($temp_name1, $fdir);
      }

      //facebook 2
      if($facebook_xls2!=""){
          if(file_exists($dir.$facebook_xls2))
          {
              $facebook_xls2= $facebook_xls2;
          }
   
          $fdir= $dir.$facebook_xls2;
          move_uploaded_file($temp_name2, $fdir);
      }      

      //linkedin 1
      if($linkedin_xls1!=""){
          if(file_exists($dir.$linkedin_xls1))
          {
              $linkedin_xls1= $linkedin_xls1;
          }
   
          $fdir= $dir.$linkedin_xls1;
          move_uploaded_file($temp_name3, $fdir);
      }           

      //linkedin 2
      if($linkedin_xls2!=""){
          if(file_exists($dir.$linkedin_xls2))
          {
              $linkedin_xls2= $linkedin_xls2;
          }
   
          $fdir= $dir.$linkedin_xls2;
          move_uploaded_file($temp_name4, $fdir);
      }         



         $query1  = "UPDATE rpprt_klanten SET klant_xls1_fb = '$facebook_xls1' WHERE ID= '$klantID'  ";
         $query2  = "UPDATE rpprt_klanten SET klant_xls2_fb = '$facebook_xls2' WHERE ID= '$klantID'  ";
         $query3  = "UPDATE rpprt_klanten SET klant_xls1_linkedin = '$linkedin_xls1' WHERE ID= '$klantID'  ";
         $query4  = "UPDATE rpprt_klanten SET klant_xls2_linkedin = '$linkedin_xls2' WHERE ID= '$klantID'  ";
 
         mysqli_query($db,$query1) or die(mysqli_error($db));
         mysqli_query($db,$query2) or die(mysqli_error($db));
         mysqli_query($db,$query3) or die(mysqli_error($db));
         mysqli_query($db,$query4) or die(mysqli_error($db));
           
        // echo "<div class='titelblok'> <h2 class='klantentitel'> Files Uploaded And Converted Successfully </h2> </div>";
}

?>  


<script type="text/javascript">
    
/* set up XMLHttpRequest */
    
        var url = "/wp-content/plugins/morres-marketing-tool/upload/visitors.xls";
        var oReq = new XMLHttpRequest();
        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";

        oReq.onload = function(e) {
            var arraybuffer = oReq.response;

            /* convert data to binary string */
            var data = new Uint8Array(arraybuffer);
            var arr = new Array();
            for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
            var bstr = arr.join("");

            /* Call XLSX */
            var workbook = XLSX.read(bstr, {
                type: "binary"
            });

            /* DO SOMETHING WITH workbook HERE */
            var first_sheet_name = workbook.SheetNames[0];
            /* Get worksheet */
            var worksheet = workbook.Sheets[first_sheet_name];
            //console.log(XLSX.utils.sheet_to_json(worksheet, {raw: true
           // }));
            var worksheet = XLSX.utils.sheet_to_json(worksheet);
            
            var file = JSON.stringify(worksheet);

            //console.log(file);

            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(worksheet));
            var dlAnchorElem = document.getElementById('downloadAnchorElem');
            dlAnchorElem.setAttribute("href",     dataStr     );
            dlAnchorElem.setAttribute("download", "linkedin_1.json");
            dlAnchorElem.click();

        }

        oReq.send();

</script>

<script type="text/javascript">
    
/* set up XMLHttpRequest */
    
        var url = "/wp-content/plugins/morres-marketing-tool/upload/update.xls";
        var oReq = new XMLHttpRequest();
        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";

        oReq.onload = function(e) {
            var arraybuffer = oReq.response;

            /* convert data to binary string */
            var data = new Uint8Array(arraybuffer);
            var arr = new Array();
            for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
            var bstr = arr.join("");

            /* Call XLSX */
            var workbook = XLSX.read(bstr, {
                type: "binary"
            });

            /* DO SOMETHING WITH workbook HERE */
            var first_sheet_name = workbook.SheetNames[0];
            /* Get worksheet */
            var worksheet = workbook.Sheets[first_sheet_name];
            //console.log(XLSX.utils.sheet_to_json(worksheet, {raw: true
           // }));
            var worksheet = XLSX.utils.sheet_to_json(worksheet);
            
            var file = JSON.stringify(worksheet);

            //console.log(file);

            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(worksheet));
            var dlAnchorElem = document.getElementById('downloadAnchorElem');
            dlAnchorElem.setAttribute("href",     dataStr     );
            dlAnchorElem.setAttribute("download", "linkedin_2.json");
            dlAnchorElem.click();

        }

        oReq.send();

</script>

<script type="text/javascript">
    
/* set up XMLHttpRequest */
    
        var url = "/wp-content/plugins/morres-marketing-tool/upload/berichten.xls";
        var oReq = new XMLHttpRequest();
        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";

        oReq.onload = function(e) {
            var arraybuffer = oReq.response;

            /* convert data to binary string */
            var data = new Uint8Array(arraybuffer);
            var arr = new Array();
            for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
            var bstr = arr.join("");

            /* Call XLSX */
            var workbook = XLSX.read(bstr, {
                type: "binary"
            });

            /* DO SOMETHING WITH workbook HERE */
            var first_sheet_name = workbook.SheetNames[0];
            /* Get worksheet */
            var worksheet = workbook.Sheets[first_sheet_name];
            //console.log(XLSX.utils.sheet_to_json(worksheet, {raw: true
           // }));
            var worksheet = XLSX.utils.sheet_to_json(worksheet);
            
            var file = JSON.stringify(worksheet);

            //console.log(file);

            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(worksheet));
            var dlAnchorElem = document.getElementById('downloadAnchorElem');
            dlAnchorElem.setAttribute("href",     dataStr     );
            dlAnchorElem.setAttribute("download", "facebook_1.json");
            dlAnchorElem.click();

        }

        oReq.send();

</script>

<script type="text/javascript">
    
/* set up XMLHttpRequest */
    
        var url = "/wp-content/plugins/morres-marketing-tool/upload/pagina.xls";
        var oReq = new XMLHttpRequest();
        oReq.open("GET", url, true);
        oReq.responseType = "arraybuffer";

        oReq.onload = function(e) {
            var arraybuffer = oReq.response;

            /* convert data to binary string */
            var data = new Uint8Array(arraybuffer);
            var arr = new Array();
            for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
            var bstr = arr.join("");

            /* Call XLSX */
            var workbook = XLSX.read(bstr, {
                type: "binary"
            });

            /* DO SOMETHING WITH workbook HERE */
            var first_sheet_name = workbook.SheetNames[0];
            /* Get worksheet */
            var worksheet = workbook.Sheets[first_sheet_name];
            console.log(XLSX.utils.sheet_to_json(worksheet, {raw: true
           }));
            var worksheet = XLSX.utils.sheet_to_json(worksheet);
            
            var file = JSON.stringify(worksheet);

            console.log(file);

            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(worksheet));
            var dlAnchorElem = document.getElementById('downloadAnchorElem');
            dlAnchorElem.setAttribute("href",     dataStr     );
            dlAnchorElem.setAttribute("download", "facebook_2.json");
            dlAnchorElem.click();

        }

        oReq.send();

</script>
 <a id="downloadAnchorElem" style="display:none"></a> 


<form id="klantenform" class="klantenform" action="?pagina=get_klanten" method="POST" style="display: none">
    <input type="submit" id="submit" name="submit" value="Volgende"> 
</form>


<script type="text/javascript">
  
  document.getElementById('submit').click();


</script>




























