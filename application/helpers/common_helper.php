<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');function isLoggedIn() {	$CI = & get_instance();	if (!$CI->session->is_logged_in) {		return false;	}	return true;}function requireLogin() {	if (!isLoggedIn()) {		redirect('/login');		return;	}}function activeUser() {	$CI = & get_instance();	return $CI->session->activeUser;}function platform() {	$CI = & get_instance();	return $CI->session->platform;}function enableProfiler() {	$CI = & get_instance();	if ($_SERVER['REMOTE_ADDR'] == '90.191.68.181' || $_SERVER['REMOTE_ADDR'] == '2001:7d0:828b:2201:9c74:4586:9bdf:561a') {		$CI->output->enable_profiler(TRUE);	}}function formatDate($date) {	return date('j F, Y', strtotime($date));}