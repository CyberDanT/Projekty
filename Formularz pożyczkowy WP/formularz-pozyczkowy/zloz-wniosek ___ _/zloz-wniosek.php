<?php
@session_start();
/**
 * Plugin Name: Formularz pożyczkowy
 * Description: Wtyczka dodaje formularz pożyczkowy na stronę.
 * Version: 1.0
 */
 
function fp_display_wnioski(){ 
	require_once('css/style.css');
	require_once('formularz-wnioski.php');
	require_once('javascript/scripts.js');
}
add_shortcode('fp-display-wnioski' , 'fp_display_wnioski');


function fp_display_form(){ 
	require_once('css/style.css');
	require_once('formularz-pozyczkowy.php');
	require_once('javascript/scripts.js');
}
add_shortcode('fp-display-form' , 'fp_display_form');

function fp_display_formlog(){ 
	require_once('css/style.css');
	require_once('formularz-logowania.php');
	require_once('javascript/scripts.js');
}
add_shortcode('fp-display-formlog' , 'fp_display_formlog');

function fp_display_formlogout(){ 
	require_once('css/style.css');
	require_once('formularz-wylogowania.php');
}
add_shortcode('fp-display-formlogout' , 'fp_display_formlogout');


function fp_display_formusun(){ 
	require_once('css/style.css');
	require_once('formularz-usuwanie.php');
}
add_shortcode('fp-display-formusun' , 'fp_display_formusun');

function fp_display_formdane(){ 
	require_once('css/style.css');
	require_once('formularz-dane.php');
	require_once('javascript/scripts.js');
}
add_shortcode('fp-display-formdane' , 'fp_display_formdane');

function fp_display_formtel(){ 
	require_once('css/style.css');
	require_once('formularz-telefon.php');
	require_once('javascript/scripts.js');
}
add_shortcode('fp-display-formtel' , 'fp_display_formtel');



function fp_baza(){
	global $wpdb;
	
	$table_name = $wpdb->prefix. "fp_uzytkownicy";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'" ) != $table_name){
		$sql= "CREATE TABLE $table_name (
			   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			   imie VARCHAR(30) NOT NULL,
			   nazwisko VARCHAR(30) NOT NULL,
			   pesel VARCHAR(30) NOT NULL,
			   haslo VARCHAR(30) NOT NULL,
			   telefon VARCHAR(30) NOT NULL,
			   miejscowosc VARCHAR(30) NOT NULL,
			   ulica VARCHAR(30) NOT NULL,
			   reg_date TIMESTAMP
			   );";
		require_once (ABSPATH. 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);
		// $wpdb->query($sql);
	}
	
	$table_name = $wpdb->prefix. "fp_pozyczki";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'" ) != $table_name){
		$sql= "CREATE TABLE $table_name (
			   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			   pesel VARCHAR(30) NOT NULL,
			   kwotapozyczki VARCHAR(30) NOT NULL,
			   czaspozyczki VARCHAR(30) NOT NULL,
			   iloscrat VARCHAR(30) NOT NULL,
			   status VARCHAR(30) NOT NULL
			   );";
		require_once (ABSPATH. 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);
		// $wpdb->query($sql);
	}
}
register_activation_hook(__FILE__, 'fp_baza');