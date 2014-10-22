<?php

/**
 * Plugin Name: LaravelWP
 * Description: Integrates Laravel with Wordpress
 */


function integrate_laravel() 
{

    global $wp_query;

    if ($wp_query->is_404) 
    { 
    	$wp_query->is_404 = false;
 
		require __DIR__.'/src/bootstrap/autoload.php';

		$app = require_once __DIR__.'/src/bootstrap/start.php';

		$app->run();

		
		if (!defined('HANDLED_BY_LARAVEL'))
		{
			// IF HANDLED BY LARAVEL then end.
			exit();
		}
		else
		{
			$wp_query->is_404 = true;
			status_header(404);			
		}
    } 

}

add_action( 'template_redirect', 'integrate_laravel');

