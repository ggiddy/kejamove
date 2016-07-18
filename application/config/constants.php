<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/*
custom constants
 */

//base fares
define('PICKUP_BASE_FARE',		1500);
define('CANTER_BASE_FARE',		2500);
define('FH_BASE_FARE',			4500);

//distance charges
define('PICKUP_KM_FARE',		1000/3);
define('CANTER_KM_FARE',		1400/3);
define('FH_KM_FARE',			2000/3);

//Helper charges
define('HELPER_GROUND',				600);
define('HELPER_NOT_GROUND',			800);

//packaging charges
define('PACKAGING_SMALL',			3000);
define('PACKAGING_NORMAL',			3500);
define('PACKAGING_BIG',				6500);
define('PACKAGING_JUMBO',			8000);

//Addon charges
define('HOUSE_CLEANING',				2000);
define('INTERIOR_DECORATOR',			2000);


/* End of file constants.php */
/* Location: ./application/config/constants.php */