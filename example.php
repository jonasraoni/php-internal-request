<?php
/*
 * Internal Request: Provides a sub request without opening http connections to the server
 * Jonas Raoni Soares da Silva <http://raoni.org>
 * https://github.com/jonasraoni/php-internal-request
 */
 
require_once 'internal-request.php';

if(isset($_GET['test']))
	echo '[Sub request]';
else{
	echo '[Request]';
	echo internalRequest('example.php?test=1');
}