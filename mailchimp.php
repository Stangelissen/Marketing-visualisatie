<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php
include ("connect.php");

$db = new mysqli('localhost', $username, $password, $database);
if (!$db) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '
       . mysqli_connect_error());
} 



//echo $_SESSION["klant_mailchimp"] ;  // Displaying Selected Value


//echo  = $_SESSION["klant_mailchimp"] ;
// echo "You have selected :" . $_SESSION["klant_naam"]; 

$klantID = $_SESSION["gekozen_klant"];

$klant_naam = $_SESSION["klant_naam"];

echo "<div class='titelblok'> <h2 class='klantentitel'> " . $klant_naam . "</h2> </div>";  




?>       

<div class="mailings">

    <div class="titelrapport">
        <h2 class="titelonderdeel">Nieuwsbrieven overzicht</h2>
    </div>





    <?php


      $api_key = $_SESSION["klant_mailchimp"];
       
      // Query String Perameters are here
      // for more reference please vizit http://developer.mailchimp.com/documentation/mailchimp/reference/lists/
      $data = array(
        //'fields' => 'lists', // total_items, _links
        //'email' => 'misha@rudrastyh.com',
        'count' => 5, // the number of lists to return, default - all
        'before_date_created' => '2019-05-01 10:30:50', // only lists created before this date
        'after_date_created' => '2019-01-01' // only lists created after this date
      );
       
      $url = 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/reports/';
      $result = rudr_mailchimp_curl_connect( $url, 'GET', $api_key, $data);
      //print_r( $result);
      $result = json_decode($result);
      // print_r( $result);


      if( !empty($result->reports) ) {
        //echo '<select>';
        foreach( $result->reports as $reports ){
         // echo '<option value="' . $reports->id . '">' . $reports->name . ' (' . $reports->stats->member_count . ')</option>';
          // you can also use $list->date_created, $list->stats->unsubscribe_count, $list->stats->cleaned_count or vizit MailChimp API Reference for more parameters (link is above)
        }
        //echo '</select>';
      } elseif ( is_int( $result->status ) ) { // full error glossary is here http://developer.mailchimp.com/documentation/mailchimp/guides/error-glossary/
        echo '<strong>' . $result->title . ':</strong> ' . $result->detail;
      }


      function rudr_mailchimp_curl_connect( $url, $request_type, $api_key, $data = array() ) {
        if( $request_type == 'GET' )
          $url .= '?' . http_build_query($data);
       
        $mch = curl_init();
        $headers = array(
          'Content-Type: application/json',
          'Authorization: Basic '.base64_encode( 'M. Marketing HR2day:'. $api_key )
        );
        curl_setopt($mch, CURLOPT_URL, $url );
        curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($mch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($mch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
        curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type); // according to MailChimp API: POST/GET/PATCH/PUT/DELETE
        curl_setopt($mch, CURLOPT_TIMEOUT, 10);
        curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
       
        if( $request_type != 'GET' ) {
          curl_setopt($mch, CURLOPT_POST, true);
          curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
        }
       
        return curl_exec($mch);
      }



          if (count($result->reports)) {
              // Open the table
                  echo "<table id='mail_table'>";
                  echo "<tr>";
                  echo "<th>Datum</th>";
                  echo "<th>Onderwerp</th>";
                  echo "<th>Verzonden</th>";
                  echo "<th>Geopend</th>";
                  echo "<th>Open ratio</th>";
                  echo "<th>Unieke clicks</th>";
                  echo "<th>Click ratio</th>";
                  echo "<th>Afgemeld</th>";
                  echo "<th>Hard bounces</th>";
                  echo "</tr>";

              // Cycle through the array
              foreach ($result->reports as $report) {
                  //var_dump($report->bounces);
                  

                  $send_time = $report->send_time;
                  $time = strtotime($send_time);
                  $format_time = date('m/d/Y', $time);
                  $subject_line = $report->subject_line;
                  $emails_sent = $report->emails_sent;
                  $unique_opens = $report->opens->unique_opens;
                  $open_rate = $report->opens->open_rate;
                  $ratio = 100;
                  $open_ratio = round($open_rate * $ratio);
                  $click_rate = $report->clicks->click_rate;
                  $click_ratio = round($click_rate * $ratio);

                  $unique_subscriber_clicks = $report->clicks->unique_subscriber_clicks;
                  
                  $unsubscribed = $report->unsubscribed;
                  $hard_bounces = $report->bounces->hard_bounces;


                  // Output a row

                  echo "<tr>";
                  echo "<td>$format_time</td>"; 
                  echo "<td>$subject_line</td>";
                  echo "<td>$emails_sent</td>";
                  echo "<td>$unique_opens</td>";
                  echo "<td>$open_ratio%</td>";
                  echo "<td>$unique_subscriber_clicks</td>";
                  echo "<td>$click_ratio%</td>";
                  echo "<td>$unsubscribed</td>";
                  echo "<td>$hard_bounces</td>";
                  echo "</tr>";
              }

              // Close the table
              echo "</table>";
          }


    ?>

    <div id="mail_feedback">
    
    </div>

    <form id="texttoevoegen">
        <div><textarea class="example-default-value" id="example-textarea">Typ hier je feedback of advies.</textarea>
        </div>
        <div><br><input type="button" id="formknop" value="Plaats feedback" onclick="example_append()"/> <input type="button" id="formknop" value="Sluit veld" onclick="sluit()" /></div>
    </form>



</div>





<script language="javascript">
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
  function example_append() {
      $('#mail_feedback').append($('#example-textarea').val());
  }






  function sluit() {
    var x = document.getElementById("texttoevoegen");
    if (x.style.display === "none") {
      x.style.display = "block";

    } else {
      x.style.display = "none";
    }
  }
</script>

<footer id="pagebreak"></footer>









