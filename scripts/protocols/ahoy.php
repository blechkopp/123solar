<?php
if (!defined('checkaccess') && FALSE) {die('Direct access not permitted');}

$CMD_RETURN = ''; // Always initialize
$ip_addr = "192.168.178.99"; //change to local environment
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://".$ip_addr."/api/inverter/id/0");
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$CMD_RETURN = strip_tags(curl_exec($ch));
curl_close($ch);

$result = json_decode($CMD_RETURN, true);
//print_r($result);

//https://github.com/jeanmarc77/123solar/wiki/3)-Protocols#yourprotocolphp-this-script-is-called-as-much-as-possible
if (json_last_error() === JSON_ERROR_NONE) {
  //String1
	$I1V = (float) $result['ch'][1][0]; // udc
	$I1A = (float) $result['ch'][1][1]; // idc
	$I1P = (float) $result['ch'][1][2]; // pdc
	
	//String2
	$I2V = (float) $result['ch'][2][0]; // udc
	$I2A = (float) $result['ch'][2][1]; // idc
	$I2P = (float) $result['ch'][2][2]; // pdc

	$G1V = (float) $result['ch'][0][0]; // uac
	$G1A = (float) $result['ch'][0][1]; // iac
	$G1P = (float) $result['ch'][0][2]; // pac
	
	$FRQ = (float) $result['ch'][0][3]; // frq
	$EFF = (float) $result['ch'][0][9]; // feff
	$BOOT = (float) $result['ch'][0][5]; // temp
	
	$KWHT = (float) $result['ch'][0][6]; // YieldTotal // yieldtotal
	$RET = 'OK';
} else {
	$RET = 'NOK';
}

?>
