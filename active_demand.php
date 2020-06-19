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


<?php
function activedemand_get($url, $timeout, $args = array())
{

    $fields_string = activedemand_field_string($args);

    if (in_array('curl', get_loaded_extensions())) {
        $ch = curl_init($url . "?" . $fields_string);  // initialize curl with given url
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
        curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);//force IP4
        $result = curl_exec($ch);
        curl_close($ch);
    } elseif (function_exists('file_get_contents')) {
        $result = file_get_contents($url);
    }

    return $result;
}

function activedemand_post($url, $args, $timeout)
{
    $fields_string = activedemand_field_string($args);

    if (in_array('curl', get_loaded_extensions())) {
        $ch = curl_init($url); // initialize curl with given url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]); // set  useragent
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // write the response to a variable
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); // max. seconds to execute
        curl_setopt($ch, CURLOPT_FAILONERROR, 1); // stop when it encounters an error
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);//force IP4
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $result = curl_exec($ch);
        if ($result === false) {
            error_log('ActiveDEMAND Web Form error: ' . curl_error($ch));
        }

        curl_close($ch);
    }


    return $result;
}

function activedemand_field_string($args)
{


    $fields_string = "";
    $activedemand_appkey = "api-key=9f5922-e6a0f7c9-3817bc25-04ef2c-44ae90fd";
    $fields = array(
        'api-key' => $activedemand_appkey,
    );
    if (is_array($args)) {
        $fields = array_merge($fields, $args);
    }
    $fields_string = http_build_query($fields);

    return $fields_string;
}



function _example()
{
    //example calls
    $fields = array();
    $form_xml = simplexml_load_string($form_str);


    $fields = array();

    array_push($fields['first_name'], "John");
    array_push($fields['last_name'], "Smith");
    array_push($fields['emails.email_address'], "john.smith@home.com");
    array_push($fields['custom_53'], "Friend");

    activedemand_get("https://api.activedemand.com/v1/contacts", $fields, 5);

}


?>