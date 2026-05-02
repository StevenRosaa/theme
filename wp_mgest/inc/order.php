<?php



session_start();



$size = $_GET['size'];

$img_size = $_GET['img_size'];

$class = $_GET['class'];

$title_len = $_GET['title_len'];

$descr_len = $_GET['descr_len'];

$pagina = $_GET['pagina'];

$visualizza = $_GET['visualizza'];

$marca = $_GET['marca'];

$categoria = $_GET['categoria'];

$page_link = $_GET['page_link'];

$modello = $_GET['modello'];

$data = $_GET['data'];



function cmp($a, $b) {

	if($_GET['ordina'] == 'title'){

		if($_GET['inverti'] == 0){

			return strcmp($a->{$_GET['ordina']},$b->{$_GET['ordina']});

		}else{

			return strcmp($b->{$_GET['ordina']},$a->{$_GET['ordina']});

		}

	}else{

		if($_GET['ordina'] == 'first_registration_date' || $_GET['ordina'] == 'insertion_date'){

			if($_GET['inverti'] == 0){

				//print substr($a->{$_GET['ordina']},-4)." - ".substr($b->{$_GET['ordina']},-4);

		        return substr($a->{$_GET['ordina']},-4) - substr($b->{$_GET['ordina']},-4);

			}else{

				return substr($b->{$_GET['ordina']},-4) - substr($a->{$_GET['ordina']},-4);

			}

		}else{

			if($_GET['inverti'] == 0){

		        return str_replace(".","",$a->{$_GET['ordina']}) - str_replace(".","",$b->{$_GET['ordina']});

			}else{

				return str_replace(".","",$b->{$_GET['ordina']}) - str_replace(".","",$a->{$_GET['ordina']});

			}

		}

	}

	

}

usort($_SESSION['mrmapi'], "cmp");



//$num_ads = count($_SESSION['mrmapi']);


$num_ads2 = 0;
//$check = true;
foreach ($_SESSION['mrmapi'] as $make) {
	$anno = explode("-", $make->{'first_registration_date'});	
	if((!$marca || $make->{'make'} == $marca) && (!$modello || $make->{'model'} == $modello) && (!$categoria || $make->{'vehicle_class'} == $categoria) && (!$data || (isset($anno[1]) && $anno[1] == $data))){
		$num_ads2++;
		//$check = false;
	}
}

/*if($check){
	$num_ads2 = $num_ads;
}*/





$trovati = '';

if($num_ads2 == 0){

	$trovati = 'Nessun annuncio visualizzato';

}else{

	if($num_ads2 == 1){

		$trovati = '1 annuncio visualizzato';

	}else{

		if($num_ads2<=$visualizza){

			$trovati = "1 - ".$num_ads2." annunci visualizzati";

		}else{

			$capienza_pag = ($visualizza*$pagina);

			$limit_pag_sup = $capienza_pag;

			if($capienza_pag>$num_ads2){

				$limit_pag_sup = $num_ads2;

			}

			$limit_inf_pag = ($capienza_pag-$visualizza)+1;

			$trovati = $limit_inf_pag." - ".$limit_pag_sup." annunci visualizzati";

		}

	}

}







/*foreach ($_SESSION['mrmapi'] as $key => $value) {

	# code...

}*/



//var_dump($_SESSION['mrmapi']);



$foot = '<div class="wp_mgest_annunci_trovati"><span id="wp_mgest_trovatio">'.$trovati.' su <b>'.$num_ads2.'</b> trovati</span></div>';



$pagine = 1;

while($num_ads2 > $visualizza){

	$num_ads2 = $num_ads2 - $visualizza;

	$pagine++;

}



$foot .= '<input type="hidden" id="wp_mgest_tot_pagine" value="'.$pagine.'" >';



$conta_annunci = 0;

$foot2 = '<div class="wp_mgest_annunci_paginazione" id="wp_mgest_annunci_paginazione_bottom">

						<a href="javascript:void(0)" id="p2" class="wp_mgest_prec" onclick="wp_mgest_ricerca(\'prec\')">&lt; prec. &nbsp;</a>

						<span id="wp_mgest_pagine2">';

$cont = 1;

while ($pagine > 0) {

	if($cont == $pagina)

		$foot2 .= $cont." &nbsp;";

	else

		$foot2 .= '<a href="javascript:void(0)" onclick=\'wp_mgest_ricerca("'.$cont.'")\'>'.$cont.' &nbsp;</a>';

	$cont++;

	$pagine--;

}

	$foot2 .= '</span>

			<a href="javascript:void(0)" id="n2" class="wp_mgest_succ" onclick="wp_mgest_ricerca(\'succ\')">succ. &gt;</a>

		</div><br>';



$html = $foot2;

if ($size !='4' && $size !='6'){

	$html .= '<table id="wp_mgest_annunci"';

	if($size=='2') 

		$html .= 'cellpadding="5px"'; 

	else 

		$html .= 'class="wp_mgest_annunci"';

	$html .= '>';

	      

	    foreach($_SESSION['mrmapi'] as $ad){
	    	$anno = explode("-", $ad->{'first_registration_date'});
	    	if((!$marca || ($ad->{'make'} == $marca)) && (!$categoria || ($ad->{'vehicle_class'} == $categoria)) && (!$modello || ($ad->{'model'} == $modello)) && (!$data || (isset($anno[1]) && $anno[1] == $data))){

		    	if($conta_annunci < ($visualizza*$pagina) && $conta_annunci >= ($visualizza*($pagina-1))){

			      	$photos = isset($ad->{'images'}) ? $ad->{'images'} : array();

			      	$title = $ad->{'title'};

			      	if ($size == '5' || $size == '7'){

			      		if($descr_len == '100')

			      			$descr_len = '500';

			      		$title = '<span class="wp_mgest_ad_title">'.$title.' '.$ad->{'sub_title'}.'</span>';

			      	}

			      	$html .= "<thead>

			      	</thead>

			      	<tbody>

			        <tr>

			          <td><a href=\"".$page_link."?&id_matic=".$ad->{'ad_number'}."\"><img src='".$photos[0]."' ".$img_size."></a></td>

			          <td class='wp_mgest_ad_row' ";

			          if($size=='2') 

			          	$html .= "style='padding-left: 7px;' >";

			          if($size != '2'){

			              $html .= "><a href=\"".$page_link."?&id_matic=".$ad->{'ad_number'}."\" style='text-decoration:none;'>".$title."</a><br>";

			          }

			          $html .= '<div class="wp_mgest_ad_row_div">';

				      if($size == '1') {

						$html .=  '<span class="'.$class.'"> € '.$ad->{'price'}.'</span><br>

				              <span class="'.$class.'"> '.$ad->{'mileage'}.' km</span><br>

				              <span class="'.$class.'"> '.str_replace("-","/",$ad->{'first_registration_date'}).' </span>&nbsp;';

				      }

				      if($size == '3' || $size == '5' || $size == '7'){

				        $html .= '<br><span class="'.$class.'">€'.$ad->{'price'}.'</span>&nbsp;

				              <span class="'.$class.'"> '.$ad->{'mileage'}.'km </span>&nbsp;

				              <span class="'.$class.'"> '.str_replace("-","/",$ad->{'first_registration_date'}).' </span>&nbsp;';

				      }

				      if($size == '5' || $size == '7'){

				        $html .=  '<span class="'.$class.'"> '.$ad->{'power_kw'}."kw".' </span>&nbsp;

				              <span class="'.$class.'"> '.$ad->{'power_cv'}."cv".' </span>&nbsp;

				              <span class="'.$class.'"> '.$ad->{'vehicle_class'}.' </span>&nbsp;

				              <span class="'.$class.'"> '.$ad->{'vehicle_category'}.' </span>&nbsp;

				              <span class="'.$class.'"> '.$ad->{'fuel_type'}.' </span>&nbsp;';

				      }

				      $html .=  '<br><br>';

				      if ($descr_len > 0 && $size > 2){

			              if(strlen($ad->{'description'}) > $descr_len){

			              	$ad->{'description'} = substr($ad->{'description'},0,$descr_len)."...";

			              }

			              $html .= $ad->{'description'};

			          }

			          if($size == '2'){ 

			          	$html .= "<a href=\"".$page_link."?&id_matic=".$ad->{'ad_number'}."\">".$ad->{'make'}." ".$ad->{'model'}."</a><br>

			          	&middot;<span class=\"".$class."\"> € ".$ad->{'price'}."</span><br>

			          	&middot;<span class=\"".$class."\"> ".$ad->{'mileage'}." km </span><br>

			          	&middot;<span class=\"".$class."\"> ".str_replace("-","/",$ad->{'first_registration_date'})." </span>";

			          }

			          $html .= '</div>

			          </td>

			        </tr>

			        </tbody>';

			    }

			    $conta_annunci++;

			}

	    }

	 	$html .= '</table>';

}else{

	$html .= '<ul class="wp_mgest_img-list'.$size.'">';

	foreach($_SESSION['mrmapi'] as $ad){
		$anno = explode("-", $ad->{'first_registration_date'});
		if((!$marca || ($ad->{'make'} == $marca)) && (!$categoria || ($ad->{'vehicle_class'} == $categoria)) && (!$modello || ($ad->{'model'} == $modello)) && (!$data || (isset($anno[1]) && $anno[1] == $data))){

			if($conta_annunci < ($visualizza*$pagina) && $conta_annunci >= ($visualizza*($pagina-1))){

				$photos = $ad->{'images'};

				$title = $ad->{'make'}.' '.$ad->{'model'};

				if(strlen($title)>$title_len){

					$title = substr($title,0,$title_len)."...";

				}

				$html .= '<li>';

				if($size == '6'){

					$html .= '<span class="wp_mgest_title6">'.$title.'</span>';

					$row = '€ '.$ad->{'price'}.'<br>'.$ad->{'mileage'}.' km<br>'.str_replace("-","/",$ad->{'first_registration_date'});

				}else{

					$row = $title.'<br>€ '.$ad->{'price'}.'<br>'.$ad->{'mileage'}.' km';

				}

				

				$html .= '<a href="'.$page_link.'?&id_matic='.$ad->{'ad_number'}.'">

				<img '.$img_size.' src="'.$photos[0].'">

				<br>

				<span class="wp_mgest_text-content'.$size.'">

				<span>'.$row.'</span>

				</span>

				</a>

				</li>';

			}

			$conta_annunci++;

		}

	}

	$html .= "</ul>";

}



$html .= $foot.$foot2;



print $html;