<?php
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