<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('vardump')) {

    function vardump($obj) {
        echo '<pre>';
        var_dump($obj);
        echo '</pre>';
    }

}