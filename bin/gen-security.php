<?php
 
$salt = genrandom(40);
$seed = genrandom(29, "0123456789");
 
echo "\tConfigure::write('Security.salt', '$salt');\n";
echo "\tConfigure::write('Security.cipherSeed', '$seed');\n";
 
function genrandom($len, $salt = null) {
	if (empty($salt)) {
		$salt = salt('a', 'z'). salt('A', 'Z'). salt('0', '9');
	}
	
	$str = "";
	
	for ($i = 0; $i < $len; $i++) {
		$index = rand(0, strlen($salt) - 1);
		$str .= $salt[$index];
	}
	
	return $str;
}
 
function salt($from, $end) {
	$salt = '';
	
	for ($no = ord($from); $no <= ord($end); $no++) {
		$salt .= chr($no);
	}
	
	return $salt;
}
