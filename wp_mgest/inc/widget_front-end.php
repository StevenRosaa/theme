<?php



echo $before_widget;



echo $before_title . $title . $after_title;



$img_size = '';

$class = '';

$title_len = '';



switch($size){

	case 1:

		$img_size = 'width="76px" height="57px"';

		$class = 'wp_mgest_size1';

	break;

	case 2:

		$img_size = 'width="76px" height="57px"';

		$class = 'wp_mgest_size2';

	break;

	case 3:

		$img_size = 'width="108px" height="81px"';

		$class = 'wp_mgest_size3';

	break;

	case 4:

		$img_size = 'width="108px" height="81px"';

		$title_len = 10;

	break;

	case 5:

		$img_size = 'width="280px" height="210px"';

		$class = 'wp_mgest_size5';

	break;

	case 6:

		$img_size = 'width="280px" height="210px"';

		$class = 'wp_mgest_size6';

		$title_len = 17;

	break;

}



?>

		

		<div id="wp_mgest_widget" class="wp_mgest_widget">

		<?php

			if ($size !='4' && $size !='6'){

				$html .= '<table id="wp_mgest_annunci" class="wp_mgest_annunci_wid">';

				      

				    foreach($wp_mgest_api as $ad){

				    	if($make=='0' || $ad->{'make'} == $make){

						      	$photos = $ad->{'images'};

						      	$title = $ad->{'title'};

						      	if ($size == '5' || $size == '7'){

						      		if($descr_len == '100')

						      			$descr_len = '500';

						      		$title = '<span class="wp_mgest_ad_title_wid">'.$title.' '.$ad->{'sub_title'}.'</span>';

						      	}

						      	$html .= "<thead>

						      	</thead>

						      	<tbody>

						        <tr>

						          <td><a href=\"".$page_url."?id_matic=".$ad->{'ad_number'}."\"><img src='".$photos[0]."' ".$img_size."></a></td>

						          <td class='wp_mgest_ad_row'>";

						          if($size != '2'){

						              $html .= "<a href=\"".$page_url."?id_matic=".$ad->{'ad_number'}."\" class='wp_mgest_title_wid_link'>".$title."</a><br>";

						          }

						          $html .= '<div class="wp_mgest_ad_row_div_wid">';

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

							      if($size != '2'){

							      		$html .=  '<br><br>';

							      }

							      if ($descr_len > 0 && $size > 2){

						              if(strlen($ad->{'description'}) > $descr_len){

						              	$ad->{'description'} = substr($ad->{'description'},0,$descr_len)."...";

						              }

						              $html .= $ad->{'description'};

						          }

						          if($size == '2'){ 

						          	$html .= "<a href=\"".$page_url."?id_matic=".$ad->{'ad_number'}."\"  class='wp_mgest_title_wid_link'>".$ad->{'make'}." ".$ad->{'model'}."</a><br>

						          	&middot;<span class=\"".$class."\"> € ".$ad->{'price'}."</span><br>

						          	&middot;<span class=\"".$class."\"> ".$ad->{'mileage'}." km </span><br>

						          	&middot;<span class=\"".$class."\"> ".str_replace("-","/",$ad->{'first_registration_date'})." </span>";

						          }

						          $html .= '</div>

						          </td>

						        </tr>

						        </tbody>';

						}

				    }

				 	$html .= '</table>';

			}else{

				$html .= '<ul class="wp_mgest_img-list'.$size.'">';

				foreach($wp_mgest_api as $ad){

					if($make=='0' || $ad->{'make'} == $make){

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

							

							$html .= '<a href="'.$page_url.'?id_matic='.$ad->{'ad_number'}.'">

							<img '.$img_size.' src="'.$photos[0].'">

							<br>

							<span class="wp_mgest_text-content'.$size.'">

							<span>'.$row.'</span>

							</span>

							</a>

							</li>';

					}

				}

				$html .= "</ul>";

			}



			echo $html;

			?>

		</div>

		    

<?php



echo $after_widget;

?>