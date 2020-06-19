<?php
/*
Plugin Name: Marketing Rapportage Plugin
Description: Marketing Rapportage plugin
Version:     0.1
Author:      Stan Gelissen
Website:     www.stangelissen.nl
*/

// Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Proper way to enqueue scripts and styles.
 */


include_once 'connect.php';





function marketing_tool_scripts() {
	global $current_user;

    wp_register_style( 'marketing-tool-style', plugins_url( '/css/style.css', __FILE__ ));
    //wp_register_style( 'marketing-tool-style1', plugins_url( '/css/Gratis_account.css', __FILE__ ));
   // wp_register_style( 'marketing-tool-style2', plugins_url( '/css/Local_hero.css', __FILE__ ));
    wp_register_script( 'marketing-tool-script', plugins_url( '/js/script.js', __FILE__ ) , array('jquery'), '3.4.0', true );
    
	wp_enqueue_style('marketing-tool-style');
	wp_enqueue_script('marketing-tool-script');
	if (isset($current_user->roles[0])) {
		if ($current_user->roles[0] == 'Beheerder') {
			wp_enqueue_style('marketing-tool-style');
		}

		if ($current_user->roles[0] == 'Marketeer') {
				wp_enqueue_style('marketing-tool-style');
		}	

	}	//een extra stijl toegen die geen toegang geeft tot de data pagina's. 
		//Zorg ervoor dat dit  niet via inspecteren benaderbaar is. 

}
add_action( 'wp_enqueue_scripts', 'marketing_tool_scripts' );



// register [arketing_tool] shortcode
function marketing_tool_shortcode( $atts ) {
	// shortcode attributes
    $a = shortcode_atts( array(
       
    ), $atts );

	// start generating page content
	$page_content = '<div id="the-dash">';
		
		// check who's logged in
		// if not logged in:
		if (get_current_user_id() == 0) { 
			$page_content .= wp_login_form(false);
			
		} else {

			$loguit_url = wp_logout_url("/marketing-rapportage-tool/"); // to do: link aanpassen

			$page_content .= '

			<div id="menu" data-html2canvas-ignore="true">
			     <ul>
			          <li><a href="?pagina=help">Help</a></li>
			          <li><a href="?pagina=klant">Maak rapportage</a></li>
			          <li><a href="' . $loguit_url .'">Log uit</a></li>

			     </ul>
			</div>';

			$page_content .= '';


			// if customer logged in:

			if (user_can(get_current_user_id(), "edit_dashboard") || true) { // dit later verwijderen
					
					$de_pagina = isset($_GET["pagina"]) ? $_GET["pagina"] : "";

					switch ($de_pagina) {
						case "help":
							require_once("help.php");
							break;
						case "visualisatie":
							require_once("visualisatie.php");
							break;
						case "klant":
							require_once("klanten.php");
							break;
						case "get_klanten":
							require_once("get_klanten.php");
							break;
						case "help":
							require_once("social.php");
							break;	
						case "facebook":
							require_once("facebook.php");
							break;
						case "google":
							require_once("google.php");
							break;
						case "active_demand":
							require_once("active_demand.php");
							break;
						case "mailchimp":
							require_once("mailchimp.php");
							break;	
						case "upload":
							require_once("upload.php");
							break;			
						case "fileupload":
							require_once("fileupload.php");
							break;
						case "upload2":
							require_once("upload2.php");
							break;	
						case "overzicht":
							require_once("overzicht.php");
							break;	
						default:
							require_once("klanten.php");	
					}

				}	 
		
			}

    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM rpprt_klanten" );
    foreach ( $result as $print )   {
   	
			
			$page_content .= '';



		// end of page content
		$page_content .= "</div>";
	
		// return the generated content for the page
	    return $page_content;

	    

}}


add_shortcode( 'marketing_tool', 'marketing_tool_shortcode' );

 



?>












