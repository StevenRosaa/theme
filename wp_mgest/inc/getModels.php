<?php



session_start();


$marca = $_GET['marca'];

$arr_models = array();

foreach ($_SESSION['mrmapi'] as $ad) {
	if($ad->{'make'} == $marca){
		if(!in_array($ad->{'model'}, $arr_models))
			$arr_models[] = $ad->{'model'};
	}

}


$txt = '<option value="">Modello</option>';
foreach ($arr_models as $key => $value) {
	$txt .= '<option value="'.$value.'">'.$value.'</option>';
}

print $txt;