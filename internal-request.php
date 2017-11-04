<?php
/*
 * Internal Request: Provides a sub request without opening http connections to the server
 * Jonas Raoni Soares da Silva <http://raoni.org>
 * https://github.com/jonasraoni/php-internal-request
 */
 
function internalRequest($path){
	static $stack;
	$stack[] = '';
	$i = count($stack) - 1;

	if(strlen($s = ob_get_contents())){
		$i ? $stack[$i - 1] .= $s : @ob_flush();
		ob_end_clean();
	}
	$get = null;
	$pt = '';
	if(($qp = strpos($path, '?')) !== false){
		$get = $_GET;
		$pt = substr($path, 0, $qp);
		foreach(explode('&', substr($path, $qp + 1)) as $qv){
			$tv = explode('=', $qv);
			$_GET[$tv[0]] = count($tv) > 1 ? $tv[1] : '';
		}
	}
	else
		$pt = $path;
	ob_start();
	include $pt;
	$s = ob_get_contents();
	ob_end_clean();
	if(count($stack) > 1)
		ob_start();
	$get !== null && ($_GET = &$get);
	unset($get);
	return array_pop($stack) . $s;
}