<?php
/*
Plugin Name: Formularz
Description: Wtyczka pozwalająca na obsługę formularza wyboru posiłków
Version: 1.0
*/


add_action('wp_enqueue_scripts', 'plugin_styles');

function plugin_styles() {
    wp_enqueue_style('MyPluginStyles', plugins_url('/style.css', __FILE__));
    wp_enqueue_style('MyPluginDatePicker', plugins_url('/datepicker.css', __FILE__));
	wp_enqueue_style( 'MyPluginBsStyle', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
}

add_action('wp_enqueue_scripts', 'plugin_scripts');

function plugin_scripts() {
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', array ( 'jquery' ), false, true);
	wp_enqueue_script( 'jqueryui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array ( 'jquery' ), false, true);
	wp_enqueue_script( 'datepickerjs', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js', array ( 'jquery' ), false, true);
	wp_enqueue_script('MyPluginCalendar', plugins_url('/calendar.js', __FILE__), array('jquery'), false, true);
	wp_enqueue_script('MyPluginInputs', plugins_url('/inputs.js', __FILE__), array('jquery'), false, true);
}


function DisplayFormularz(){
	include_once('index.php');
}
add_shortcode('formularz', 'DisplayFormularz');
?>