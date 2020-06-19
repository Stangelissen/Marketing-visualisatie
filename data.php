<?php

    echo "string";

    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM rpprt_klanten" );
    foreach ( $result as $print )   {
   
   

            $page_content .= '

            <table>
  <tr>
    <th>Klant naam</th>
    <th>Klant E-mail</th>
    <th>Mailchimp</th>
  </tr>
  <tr>
    <td>'. $print->klant_naam .'</td>
    <td>'. $print->klant_email .'</td>
    <td>'. $print->klant_mailchimp .'</td>
  </tr>
  <tr>
    <td>'. $print->klant_naam .'</td>
    <td>'. $print->klant_email .'</td>
    <td>'. $print->klant_mailchimp .'</td>
  </tr>

</table>';



        // end of page content
        $page_content .= "</div>";
    
        // return the generated content for the page
        return $page_content;
        

}
?>



















