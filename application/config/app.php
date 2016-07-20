<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| Application Config
| -------------------------------------------------------------------
| This file contains global application specific configs
|
*/
//General
$config['app-name']='Kejamove.com';
//Directories
$config['js-root']=FCPATH;
//Requests
$config['app-move-request-from-email']='noreply@kejamove.com';
$config['app-move-request-receipt-email']='info@kejamove.com';
$config['app-move-request-cc-emails']=array(
	'info@kejahunt.com',
	'crryanlink@gmail.com'
);;