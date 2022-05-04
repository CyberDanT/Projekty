<?php
/**
* Plugin Name: Formularz pożyczkowy
* Plugin URI: https://www.biznes-marketing.com/
* Description: Formularz umożliwiający składanie wniosków o pożyczkę.
* Version: 1.0
* Author: Biznes-Marketing.com
* Author URI: https://biznes-marketing.com/

 */

register_activation_hook(__FILE__, 'formpozyczkowy_activation');

function formpozyczkowy_activation() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'formpozyczkowy_uzytkownicy';

    if ($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        $query = "CREATE TABLE " . $table_name . " (
        id int(9) NOT NULL AUTO_INCREMENT,
        nazwa_uzytkownika TEXT NOT NULL,
        imie TEXT NOT NULL,
        nazwisko TEXT NOT NULL,
        telefon NUMBER NOT NULL,
        weryfikacja_uzytkownika TEXT NOT NULL,
        data_utworzenia TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
        )";

        $wpdb->query($query);
    }
}

register_uninstall_hook(__FILE__, 'formpozyczkowy_unistall');
function formpozyczkowy_unistall(){
	if( !defined( 'WP_UNINSTALL_PLUGIN' )){
		exit();
	}
	//usuwam tabelę
	global $wpdb;
	$table_name = $wpdb->prefix . 'formpozyczkowy_uzytkownicy';
	$query ='DROP TABLE '.$table_name;
	$wpdb->query($query);
}