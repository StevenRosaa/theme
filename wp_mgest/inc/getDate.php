<?php



session_start();


$arr_anni = array();

foreach ($_SESSION['mrmapi'] as $ad) {
	$anno = explode("-", $ad->{'first_registration_date'});
	if(isset($anno[1]) && !in_array($anno[1], $arr_anni))
		$arr_anni[] = $anno[1];

}

rsort($arr_anni);
$txt = '<option value="">Anno</option>';
foreach ($arr_anni as $key => $value) {
	$txt .= '<option value="'.$value.'">'.$value.'</option>';
}

print $txt;