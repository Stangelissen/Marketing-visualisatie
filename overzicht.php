<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/wp-content/plugins/morres-marketing-tool/dist/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="/wp-content/plugins/morres-marketing-tool/dist/html2pdf.bundle.min.js"></script>
<?php

include ("connect.php");

$db = new mysqli('localhost', $username, $password, $database);
if (!$db) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '
       . mysqli_connect_error());
} 
?>

<script>
    function generatePDF() {

      // Choose the element that our invoice is rendered in.
      const element = document.getElementsByTagName('body')[0];
      // Choose the element and save the PDF for our user.
      html2pdf().from(element).save();
    }
</script>


</head>



<body>

<?php 

	if ($_SESSION["checkbox1"] == 1) {
		
		include 'mailchimp.php';
	}
	

	
	if ($_SESSION["liuploaded1"] && $_SESSION["liuploaded2"] == "true") {
		 
		 include 'visualisatie.php';
		
	}



	if ($_SESSION["fbuploaded1"] && $_SESSION["fbuploaded2"] == "true") {
		 
		include 'facebook.php';
		
	}

 
?>

<div id="pagebreak"></div>

<div id="conclusie">

    <div class="titelrapport">
        <h2 class="titelonderdeel">Conclusie</h2>
    </div>

     <div id="conclusie_feedback">
    
    </div>

      <form id="texttoevoegen11">
      <div><textarea class="example-default-value" id="textarea11">Typ hier je feedback of advies.</textarea>
      </div>
      <div><br><input type="button" id="formknop" value="Plaats feedback" onclick="example_append11()"/> <input type="button" id="formknop" value="Sluit veld" onclick="sluit11()" /></div>
  </form>


</div>

<script>

    $('.example-default-value').each(function() {
      var default_value = this.value;
      $(this).focus(function() {
          if(this.value == default_value) {
              this.value = '';
          }
      });
      $(this).blur(function() {
          if(this.value == '') {
              this.value = default_value;
          }
      });
    });
    function example_append11() {
        $('#conclusie_feedback').append($('#textarea11').val());
    }



    function sluit11() {
      var x = document.getElementById("texttoevoegen11");
      if (x.style.display === "none") {
        x.style.display = "block";

      } else {
        x.style.display = "none";
      }
    }
    
  </script>



<div id="actiepunten">

    <div class="titelrapport">
        <h2 class="titelonderdeel">Actiepunten</h2>
    </div>

     <div id="actiepunten_feedback">
    
    </div>

      <form id="texttoevoegen12">
      <div><textarea class="example-default-value" id="textarea12">Typ hier je feedback of advies.</textarea>
      </div>
      <div><br><input type="button" id="formknop" value="Plaats feedback" onclick="example_append12()"/> <input type="button" id="formknop" value="Sluit veld" onclick="sluit12()" /></div>
  </form>


</div>

<script>

    $('.example-default-value').each(function() {
      var default_value = this.value;
      $(this).focus(function() {
          if(this.value == default_value) {
              this.value = '';
          }
      });
      $(this).blur(function() {
          if(this.value == '') {
              this.value = default_value;
          }
      });
    });
    function example_append12() {
        $('#actiepunten_feedback').append($('#textarea12').val());
    }



    function sluit12() {
      var x = document.getElementById("texttoevoegen12");
      if (x.style.display === "none") {
        x.style.display = "block";

      } else {
        x.style.display = "none";
      }
    }
    
  </script>


<div class="knop2">


<button onclick="generatePDF()" id="pdfknop" data-html2canvas-ignore="true">Download PDF</button>
</div>


</body>
</html>









