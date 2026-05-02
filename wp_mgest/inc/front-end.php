<?php

if(isset($_GET['id_matic'])){
	$notfind = true;
	foreach ($wp_mgest_api as $ad) {
		if($ad->{'ad_number'} == $_GET['id_matic']){
			$notfind = false;
			$first_image = $ad->{'images'};
		?>
		<div class="wp_mgest_mainad">
			<div class="wp_mgest_main_sub_ad"><?php echo $ad->{'title'}; ?>
				<div class="wp_mgest_list_ad">
				 € <?php echo $ad->{'price'}; ?>
				 	<div style="float: left;font-size: 15px;">
				 		<ul class="wp_mgest_list_ad_items">
							<?php if($ad->{'vehicle_class'}){
		                 		echo '<li><b>Tipologia: </b><span>'.$ad->{'vehicle_class'}.'</span></li>';
							} 
							if($ad->{'make'}){
		                 		echo '<li><b>Marca: </b><span>'.$ad->{'make'}.'</span></li>';
							}
							if($ad->{'model'}){
		                 		echo '<li><b>Modello: </b><span>'.$ad->{'model'}.'</span></li>';
							}
							if($ad->{'color'}){
		                 		echo '<li><b>Colore: </b><span>'.$ad->{'color'}.'</span></li>';
							}
							if($ad->{'color_type'}){
		                 		echo '<li><b>Esterni: </b><span>'.$ad->{'color_type'}.'</span></li>';
							}
							if($ad->{'fuel_type'}){
		                 		echo '<li><b>Carburante: </b><span>'.$ad->{'fuel_type'}.'</span></li>';
							}
							if($ad->{'first_registration_date'}){
		                 		echo '<li><b>Immatricolazione: </b><span>'.str_replace("-","/",$ad->{'first_registration_date'}).'</span></li>';
							}
							if($ad->{'mileage'}){
		                 		echo '<li><b>Chilometraggio: </b><span>'.$ad->{'mileage'}.'</span></li>';
							}
							if($ad->{'power_kw'}){
		                 		echo '<li><b>Kw: </b><span>'.$ad->{'power_kw'}.'</span></li>';
							}
							if($ad->{'power_cv'}){
		                 		echo '<li><b>Cavalli: </b><span>'.$ad->{'power_cv'}.'</span></li>';
							}
							if($ad->{'vehicle_category'}){
		                 		echo '<li><b>Carrozzeria: </b><span>'.$ad->{'vehicle_category'}.'</span></li>';
							}
							?>
		                 	<li class="wp_mgest_nolist"><a class="addthis_counter addthis_pill_style"></a></li>
						</ul>
						<br>
						
				 	</div>
				 </div>
			 </div> 
			

							<script type="text/javascript" src="<?php echo $plugin_url.'/js/wp_mgest_jssor.core.js'; ?>"></script>
						    <script type="text/javascript" src="<?php echo $plugin_url.'/js/wp_mgest_jssor.utils.js'; ?>"></script>
						    <script type="text/javascript" src="<?php echo $plugin_url.'/js/wp_mgest_jssor.slider.js'; ?>"></script>
						    <script type="text/javascript" src="<?php echo $plugin_url.'/js/jquery.hashchange.min.js'; ?>"></script>
  							<script type="text/javascript" src="<?php echo $plugin_url.'/js/jquery.easytabs.min.js'; ?>"></script>


						    
						    <script>
						        jQuery(document).ready(function ($) {
						            var options = {
						                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
						                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
						                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
						                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
						                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
						                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
						                }
						            };

						            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
						        });
						    </script>
						    <!-- Jssor Slider Begin -->
						    <!-- You can move inline styles to css file or css block. -->
						    <div class="wp_mgest_slider_ad">
							    <div class="wp_mgest_slider1_container" id="slider1_container">

							        <!-- Slides Container -->
							        <div u="slides" class="wp_mgest_slides_ad">
							            <?php 
							            if($ad->{'images'}){
							            	foreach ($ad->{'images'} as $image) {?>
							            	<div><img u="image" src="<?php echo $image; ?>" /></div>
							            <?php }
							            }else{ ?>
							            	<div><img u="image" src="http://mistermatic.it/images_conc/img0000/<?php echo $ad->{'ad_number'}; ?>/0/car_big.jpg" /></div>
							            <?php } ?>
							        </div>
							        
							        <!-- Arrow Navigator Skin Begin -->
							        <style>
							            /* jssor slider arrow navigator skin 03 css */
							            /*
							            .jssora03l              (normal)
							            .jssora03r              (normal)
							            .jssora03l:hover        (normal mouseover)
							            .jssora03r:hover        (normal mouseover)
							            .jssora03ldn            (mousedown)
							            .jssora03rdn            (mousedown)
							            */
							            
							        </style>
							        <!-- Arrow Left -->
							        <span u="arrowleft" class="jssora03l">
							        </span>
							        <!-- Arrow Right -->
							        <span u="arrowright" class="jssora03r">
							        </span>
							        <!-- Arrow Navigator Skin End -->
							        <a style="display: none" href="http://www.jssor.com">javascript</a>

							    
							    <!-- Jssor Slider End -->
								</div>
						</div>
						<br>
								<div id="wp_mgest_tab-container" class="wp_mgest_tab-container">
									<ul class="wp_mgest_ul_tabs">
									<li class="wp_mgest_tab"><a href="#wp_mgest_tabs-1">Descrizione</a></li>
									<li class="wp_mgest_tab"><a href="#wp_mgest_tabs-2">Ulteriori Dettagli</a></li>
									<li class="wp_mgest_tab"><a href="#wp_mgest_tabs-3">Optionals</a></li>
									</ul>

									<div id="wp_mgest_tabs-1" class="wp_mgest_panel-container">

										
										
										<p><?php echo str_replace("\n","<br>",$ad->{'description'}); ?></p>

									</div>
									
									

									<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f3c188f442f3bf2"></script>
								
											
									<div id="wp_mgest_tabs-2" class="wp_mgest_panel-container">
									
										<ul>
	                             		<?php 
											if($ad->{'interiors_color'}){
						                 		echo '<li><b>Colori interni: </b><span>'.$ad->{'interiors_color'}.'</span></li>';
											}
											if($ad->{'interiors_type'}){
						                 		echo '<li><b>Interni: </b><span>'.$ad->{'interiors_type'}.'</span></li>';
											}
											if($ad->{'emissions_class'}){
						                 		echo '<li><b>Emissioni: </b><span>'.$ad->{'emissions_class'}.'</span></li>';
											}
											if($ad->{'gearbox'}){
						                 		echo '<li><b>Cambio: </b><span>'.$ad->{'gearbox'}.'</span></li>';
											}
											if($ad->{'weight'}){
						                 		echo '<li><b>Peso: </b><span>'.$ad->{'weight'}.'</span></li>';
											}
											if($ad->{'cubic_capacity'}){
						                 		echo '<li><b>Cilindrata: </b><span>'.$ad->{'cubic_capacity'}.'</span></li>';
											}
											if($ad->{'cylinders_count'}){
						                 		echo '<li><b>Cilindri: </b><span>'.$ad->{'cylinders_count'}.'</span></li>';
											}
											if($ad->{'num_seats'}){
						                 		echo '<li><b>Posti: </b><span>'.$ad->{'num_seats'}.'</span></li>';
											}
											if($ad->{'doors_count'}){
						                 		echo '<li><b>Porte: </b><span>'.$ad->{'doors_count'}.'</span></li>';
											}
											if($ad->{'owners_count'}){
						                 		echo '<li><b>Proprietari: </b><span>'.$ad->{'owners_count'}.'</span></li>';
											}
											if($ad->{'warranty'}){
						                 		echo '<li><b>Garanzia: </b><span>'.$ad->{'warranty'}.'</span></li>';
											}
											if($ad->{'co2_emissions'}){
						                 		echo '<li><b>Emissioni CO2: </b><span>'.$ad->{'co2_emissions'}.'</span></li>';
											}
											if($ad->{'highway_fuel_consumption'}){
						                 		echo '<li><b>Consumo extraurbano: </b><span>'.$ad->{'highway_fuel_consumption'}.'</span></li>';
											}
											if($ad->{'urban_consumption'}){
						                 		echo '<li><b>Consumo urbano: </b><span>'.$ad->{'urban_consumption'}.'</span></li>';
											}
											if($ad->{'combined_consumption'}){
						                 		echo '<li><b>Consumo combinate: </b><span>'.$ad->{'combined_consumption'}.'</span></li>';
											}
											if($ad->{'antiparticulate_filter'}){
						                 		echo '<li><b>Filtro antiparticolato: </b><span>Si</span></li>';
											}
											if($ad->{'transmission_type'}){
						                 		echo '<li><b>Trazione: </b><span>'.$ad->{'transmission_type'}.'</span></li>';
											}
										?>
	                             		
										</ul>									
										
									</div>
			                    
				                    <div id="wp_mgest_tabs-3" class="wp_mgest_panel-container">
												
										<ul>
											<?php foreach($ad->{'optionals'} as $optional){ ?>
	                             				<li><b></b><span><?php echo $optional; ?></span></li>
	                             			<?php } ?>
	                          			</ul>

									</div>

								</div>
								
								<h3>Contattaci</h3>
								
			              <form method="get" id="contactform">

			                 <p style="display:none">
			                    <label for="name">Id annuncio *: </label>
			                    <input type="hidden" name="wp_mgest_image" id="wp_mgest_image" value="<?php echo $first_image[0]; ?>" />
			                    <input type="hidden" name="wp_mgest_title" id="wp_mgest_title" value="<?php echo $ad->{'title'}; ?>" />
			                    <input type="hidden" name="wp_mgest_price" id="wp_mgest_price" value="<?php echo $ad->{'price'}; ?>" />
			                    <input type="hidden" name="wp_mgest_tipologia" id="wp_mgest_tipologia" value="<?php echo $ad->{'vehicle_category'}; ?>" />
			                    <input type="hidden" name="wp_mgest_categoria" id="wp_mgest_categoria" value="<?php echo $ad->{'vehicle_class'}; ?>" />
			                    <input type="hidden" name="wp_mgest_carburante" id="wp_mgest_carburante" value="<?php echo $ad->{'fuel_type'}; ?>" />
			                    <input type="hidden" name="wp_mgest_km" id="wp_mgest_km" value="<?php echo $ad->{'mileage'}; ?>" />
			                    <input type="hidden" name="wp_mgest_date" id="wp_mgest_date" value="<?php echo str_replace("-","/",$ad->{'first_registration_date'}); ?>" />
			                    <input type="hidden" name="wp_mgest_kw" id="wp_mgest_kw" value="<?php echo $ad->{'power_kw'}; ?>" />
			                    <input type="hidden" name="wp_mgest_cv" id="wp_mgest_cv" value="<?php echo $ad->{'power_cv'}; ?>" />
			                    <input type="hidden" name="wp_mgest_colore" id="wp_mgest_colore" value="<?php echo $ad->{'color'}; ?>" />
			                    <input type="hidden" name="wp_mgest_vernice" id="wp_mgest_vernice" value="<?php echo $ad->{'color_type'}; ?>" />
			                 
			                 </p>

			                 <p>
			                    <label for="name">Il Tuo Nome *: </label>
			                    <input class="wp_mgest_text_contact" type="text" name="nome" id="nome" placeholder="Il tuo nome" />
			                 </p>

			                 <p>
			                    <label for="mail">La Tua Mail *: </label>
			                    <input class="wp_mgest_text_contact" type="text" name="email" id="email" placeholder="La tua mail" />
			                 </p>

			                 <p>
			                    <label for="mail">Telefono *: </label>
			                    <input class="wp_mgest_text_contact" type="text" name="tel" id="tel" placeholder="Il tuo telefono" />
			                 </p>

			                 <p>
			                    <label for="comments">Messaggio *: </label>
			                    <textarea class="wp_mgest_textarea_contact" name="messaggio" id="messaggio" cols="30" rows="10" placeholder="Scrivi il tuo messaggio" ></textarea>
			                 </p>
			                 
			                 <p>
									<label for="comments">Privacy *: </label>
									<textarea class="wp_mgest_textarea_contact" readonly name="privacy" id="privacy" cols="30">LA TUTELA DEI SUOI DATI PERSONALI - Inviando questo modulo acconsento al trattamento dei miei dati personali che verranno trattati, ai sensi dell'art. 13 del D. Lgs. 196/03, da questo sito con l'ausilio di strumenti informatici solo ed esclusivamente per finalità gestionali, statistiche, iniziative marketing e promozionali legate alla propria attività.</textarea>
									<input type="checkbox" name="privacycheck" id="privacycheck" class="wp_mgest_textarea_ad_input" /><span class="wp_mgest_textarea_privacy">Accetto le condizioni sulla privacy</span>
							</p>

			                 <p>
			                    <label>&nbsp;</label>
			                    <button type="button" id="submit" onclick="wpMgestsendMail();">Invia</button>
			                 </p>

			              </form><!--/ .contact-form-->	

			              <div>
		                    <p id="wp_mgest_report"></p>
		                  </div>	
								
							</div><!--/ .entry-item-->
							
						</article><!--/ .item-->
						
					</section><!--/ #content-->

					<!-- - - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - - -->	

				</section><!--/.container -->

				<!-- - - - - - - - - - - - - end Container - - - - - - - - - - - - - - - - -->			
				
			</div><!--/ .main-->

			<script type="text/javascript">
			    jQuery(document).ready( function() {
			      jQuery('#wp_mgest_tab-container').easytabs();
			    });
			</script>
		</div>
<?php 	}
	}
	if($notfind){
		echo "Non esistono annunci per l'id specificato.";
	}
}else{ ?>
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

			
			<?php if ($full_numbers == 'yes'){ 
				?>
				<input type="hidden" id="pagina" value="1" />
				<input type="hidden" id="visualizza2" value="25" />
	
				<div>
<!--					<input type="hidden" id="pagina" value="1">-->
						
						<b>Cerca</b>
						<select id="wp_mgest_id_marca" onchange="wp_mgest_update_models();">
							<option value="">Marca</option>
							<?php foreach($marche as $nome => $key): ?>
								<option value="<?php print $nome; ?>" <?php if($nome==$make) echo "selected='selected'"; ?> ><?php print $nome; ?></option>
							<?php endforeach; ?>
						</select>
						<?php if($show_models=='yes'){ ?>
						<select id="wp_mgest_id_modello" onchange="wp_mgest_ricerca(1)">
							<option value="">Modello</option>
						</select>
						<?php }else{ ?>
							<input type="hidden" id="wp_mgest_id_modello" value="">
						<?php } ?>
						<?php if($show_date=='yes'){ ?>
						<b>Anno</b>
						<select id="wp_mgest_id_data" onchange="wp_mgest_ricerca(1)">
							<option value="">Anno</option>
						</select>
						<?php }else{ ?>
							<input type="hidden" id="wp_mgest_id_data" value="">
						<?php } ?>
						<b>Categoria</b>
						<select id="wp_mgest_id_categoria" onchange="wp_mgest_ricerca(1)">
							<option value="">Categorie</option>
							<?php foreach($categories as $nome => $key): ?>
								<option value="<?php print $nome; ?>" <?php if($nome==$category) echo "selected='selected'"; ?> ><?php print $nome; ?></option>
							<?php endforeach; ?>
						</select>
						<b>Visualizza</b>
                                                <?php 
                                                $arr_visualizza = explode(",",$visualizza); 
                                                ?>
						<select id="wp_mgest_visualizza" onchange="wp_mgest_ricerca(1,0)">
                                                    <?php foreach($arr_visualizza as $visualizza): ?>
                                                        <option value="<?php print $visualizza; ?>" ><?php print $visualizza; ?></option>
                                                    <?php endforeach; ?>
						</select>
						<b>Ordina</b>
						<select id="wp_mgest_ordina" onchange="wp_mgest_ricerca(1)">
							<option value="title" <?php if($sort=="title") echo "selected='selected'"; ?> >Titolo</option>
							<option value="first_registration_date" <?php if($sort=="first_registration_date") echo "selected='selected'"; ?> >Anno</option>
							<option value="power_kw" <?php if($sort=="power_kw") echo "selected='selected'"; ?> >Potenza</option>
							<option value="mileage" <?php if($sort=="mileage") echo "selected='selected'"; ?> >Chilometraggio</option>
							<option value="price" <?php if($sort=="price") echo "selected='selected'"; ?> >Prezzo</option>
							<option value="insertion_date" <?php if($sort=="insertion_date") echo "selected='selected'"; ?> >Inserimento</option>
						</select>
						&nbsp;&nbsp;
						<input type="checkbox" <?php if($invert=="1") echo "checked"; ?> id="wp_mgest_inverti" value=1 onchange="wp_mgest_ricerca(1)"> inverti
		
				</div>
					
			<?php }else{ ?>
				<input type="hidden" id="pagina" value="1" />
				<input type="hidden" id="visualizza2" value="25" />
				<div>
						<select style="visibility:hidden;" id="wp_mgest_id_marca" onchange="wp_mgest_ricerca(1)">
							<option value="">Marca</option>
							<?php foreach($marche as $nome => $key): ?>
								<option value="<?php print $nome; ?>" <?php if($nome==$make) echo "selected='selected'"; ?> ><?php print $nome; ?></option>
							<?php endforeach; ?>
						</select>
						<select style="visibility:hidden;" id="wp_mgest_id_categoria" onchange="wp_mgest_ricerca(1)">
							<option value="">Categorie</option>
							<?php foreach($categories as $nome => $key): ?>
								<option value="<?php print $nome; ?>" <?php if($nome==$category) echo "selected='selected'"; ?> ><?php print $nome; ?></option>
							<?php endforeach; ?>
						</select>
                                                <?php 
                                                $arr_visualizza = explode(",",$visualizza); 
                                                ?>
						<select style="visibility:hidden;" id="wp_mgest_visualizza" onchange="wp_mgest_ricerca(1,0)">
                                                    <?php foreach($arr_visualizza as $visualizza): ?>
                                                        <option value="<?php print $visualizza; ?>" ><?php print $visualizza; ?></option>
                                                    <?php endforeach; ?>
						</select>
						<select style="visibility:hidden;" id="wp_mgest_ordina" onchange="wp_mgest_ricerca(1)">
							<option value="title" <?php if($sort=="title") echo "selected='selected'"; ?> >Titolo</option>
							<option value="first_registration_date" <?php if($sort=="first_registration_date") echo "selected='selected'"; ?> >Anno</option>
							<option value="power_kw" <?php if($sort=="power_kw") echo "selected='selected'"; ?> >Potenza</option>
							<option value="mileage" <?php if($sort=="mileage") echo "selected='selected'"; ?> >Chilometraggio</option>
							<option value="price" <?php if($sort=="price") echo "selected='selected'"; ?> >Prezzo</option>
							<option value="insertion_date" <?php if($sort=="insertion_date") echo "selected='selected'"; ?> >Inserimento</option>
						</select>
						&nbsp;&nbsp;
						<input style="visibility:hidden;" type="checkbox" <?php if($invert=="1") echo "checked"; ?> id="wp_mgest_inverti" value=1 onchange="wp_mgest_ricerca(1)">
				</div>
			<?php }
			session_start();
      		$_SESSION['mrmapi'] = $wp_mgest_api;
			?>
					
					<div id="wp_mgest_risultati" onload="wp_mgest_ricerca(1)">
						<img src="<?php echo $plugin_url; ?>/images/loader01.gif" style="max-width:100px;">
					</div>
				    
	<script>

		function wp_mgest_update_years(){
			var rhttp = new XMLHttpRequest();
			var url = "<?php echo $plugin_url; ?>/inc/getDate.php";
			rhttp.open("GET", url, true);
			rhttp.send();
			rhttp.onreadystatechange = function() { 
				 if(rhttp.readyState  == 4){
					if(rhttp.status == 200) {
						jQuery("#wp_mgest_id_data").html("");
						jQuery("#wp_mgest_id_data").append(rhttp.responseText);
					}
				}
			};
		}

		function wp_mgest_update_models(){
			var marca = document.getElementById('wp_mgest_id_marca').value;
			var rhttp = new XMLHttpRequest();
			var url = "<?php echo $plugin_url; ?>/inc/getModels.php?marca="+marca;
			rhttp.open("GET", url, true);
			rhttp.send();
			rhttp.onreadystatechange = function() { 
				 if(rhttp.readyState  == 4){
					if(rhttp.status == 200) {
						jQuery("#wp_mgest_id_modello").html("");
						jQuery("#wp_mgest_id_modello").append(rhttp.responseText);
					}
				}
			};
			document.getElementById('wp_mgest_id_modello').value = '';
			wp_mgest_ricerca(1);
		}

		function wp_mgest_ricerca(pg,v){
	
		//	alert("Stampa prima " +pg);
			if(pg==undefined){
				if(document.getElementById('pagina')){
					pg=document.getElementById('pagina').value;
		//			alert(pg);
				}
			}
			
			if(pg=="prec") { 
				pg=parseInt(document.getElementById("pagina").value);
				pg=pg-1;
				if(pg==0){
					pg='not';
				}else{
					document.getElementById("pagina").value = pg;
				}
			}
			if(pg=="succ") { 
				pg=parseInt(document.getElementById("pagina").value);
				if(pg<parseInt(document.getElementById("wp_mgest_tot_pagine").value)){
					pg=pg+1; 
					document.getElementById("pagina").value = pg;
				}else{
					pg='not';
				}
				
			}
			
			if(pg != 'not'){
				if (pg==1){
					document.getElementById("pagina").value = pg;
				}
			//	alert("Stampa dopo "+pg);
				if(v==undefined){ 
					if(document.getElementById('visualizza2')){
						v=document.getElementById('visualizza2').value;
					}
				}
				if (v==0){
					document.getElementById('visualizza2').value = document.getElementById('wp_mgest_visualizza').value;
					v = document.getElementById('wp_mgest_visualizza').value;
				}
				if(document.getElementById('wp_mgest_id_marca'))
					var marca = document.getElementById('wp_mgest_id_marca').value;
				else
					var marca = 0;
				if(document.getElementById('wp_mgest_id_data'))
					var modello = document.getElementById('wp_mgest_id_modello').value;
				else
					var modello = 0;
				if(document.getElementById('wp_mgest_id_data'))
					var data = document.getElementById('wp_mgest_id_data').value;
				else
					var data = 0;
				if(document.getElementById('wp_mgest_id_categoria'))
					var categoria = document.getElementById('wp_mgest_id_categoria').value;
				else
					var categoria = 0;
				if(document.getElementById('wp_mgest_ordina'))
					var ordina = document.getElementById('wp_mgest_ordina').value;
				else
					var ordina = 0;
				if(document.getElementById('wp_mgest_visualizza'))
					var visualizza = document.getElementById('wp_mgest_visualizza').value;
				else
					var visualizza = 0;
				if(document.getElementById('wp_mgest_inverti').checked){
					var inverti = 1;
				}else{
					var inverti = 0;
				}
				var size = '<?php echo $size; ?>';
				var img_size = '<?php echo $img_size; ?>';
				var ad_class = '<?php echo $class; ?>';
				var title_len = '<?php echo $title_len; ?>';
				var descr_len = '<?php echo $descr_len; ?>';
				var page_link = '<?php echo $page_link; ?>';

				var rhttp = new XMLHttpRequest();
				var url = "<?php echo $plugin_url; ?>/inc/order.php?marca="+marca+"&modello="+modello+"&data="+data+"&categoria="+categoria+"&ordina="+ordina+"&visualizza="+visualizza+"&inverti="+inverti+"&pagina="+pg+"&size="+size+"&img_size="+img_size+"&class="+ad_class+"&title_len="+title_len+"&descr_len="+descr_len+"&page_link="+page_link;
				rhttp.open("GET", url, true);
				rhttp.send();
				rhttp.onreadystatechange = function() { 
					 if(rhttp.readyState  == 4){
						if(rhttp.status == 200) {
							jQuery("#wp_mgest_risultati").html("");
							jQuery("#wp_mgest_risultati").append(rhttp.responseText);
							document.getElementById("pagina").value = pg;
						}
					}
				};	
			}
		}

	    jQuery(document).ready( function() {
	      wp_mgest_update_years();
	      wp_mgest_ricerca(1);
	    });
	</script>

		<?php

		echo $after_widget;

}?>