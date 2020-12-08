<?php
/*
Plugin Name: cenzorship
Description: Цензура выражений.
Version: 1.0
Author: beltest
*/
define('CENZORSHIP_DIR', plugin_dir_path(__FILE__));
function cenzorship_filter($the_content){
	static $badwords = array();
	
	if(empty($badwords)){
		$badwords = explode(',', file_get_contents(CENZORSHIP_DIR . 'badwords.txt'));
	}
	
	for( $i = 0, $c = count($badwords); $i < $c; $i++ ){
		$the_content = preg_replace('#'.$badwords[$i].'#iu', '{цензура}', $the_content);
	}
	
	return $the_content;
}
add_filter('the_content', 'cenzorship_filter');
?>