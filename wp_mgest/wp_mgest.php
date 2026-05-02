<?php



/*

Plugin Name: Mgest

Plugin URI: https://motori.multigestionale.com

Description: Per includere i veicoli e le informazioni dei clienti Multigestionale all'inteno del proprio sito wordpress

Version: 2.3

Author: Multigestionale Team

Author URI: https://motori.multigestionale.com

License: GPLv2 or later

*/



if (!defined('ABSPATH')) die("Accesso diretto al file non permesso");



/*

 *

 * Assign global variables

*/



$plugin_url = WP_PLUGIN_URL . '/wp_mgest';

$options = array();







/*

 *

 * Add a link to our plugin admin menu

*/



function wp_mgest_menu(){



	/*

	 * Use the add_option_page function

	 * add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function )

	 *

	 */



	add_options_page(

			'Multigestionale Official Plugin',

			'Multigestionale Plugin',

			'manage_options',

			'wp_mgest',

			'wp_mgest_options_page'

		);

}

add_action('admin_menu', 'wp_mgest_menu');

add_action( 'plugins_loaded', 'wp_mgest_shortcode', 11 );





function wp_mgest_options_page(){



	if(!current_user_can('manage_options')){



		wp_die('Non hai i permessi necessari ad accedere a questa pagina.');

	}



	global $plugin_url;

	global $options;



	$options = get_option('wp_mgest');

	

	if( isset($_POST['wp_mgest_formcli_submitted']) ){



		$hidden_field = esc_html($_POST['wp_mgest_formcli_submitted']);



		if($hidden_field == 'Y'){



			$wp_mgest_codcliente = esc_html($_POST['wp_mgest_codcliente']);

			

			$options['wp_mgest_codcliente'] = $wp_mgest_codcliente;

			$options['last_update'] = time();



			update_option( 'wp_mgest', $options);

		}

	}



	if( isset($_POST['wp_mgest_formemail_submitted']) ){



		$hidden_field = esc_html($_POST['wp_mgest_formemail_submitted']);



		if($hidden_field == 'Y'){



			$wp_mgest_emailcontact = esc_html($_POST['wp_mgest_emailcontact']);

			

			$options['wp_mgest_emailcontact'] = $wp_mgest_emailcontact;

			$options['last_update'] = time();



			update_option( 'wp_mgest', $options);

		}

	}



	if( isset($_POST['wp_mgest_formcode_submitted']) ){



		$hidden_field = esc_html($_POST['wp_mgest_formcode_submitted']);



		if($hidden_field == 'Y'){



			$wp_mgest_apicode = esc_html($_POST['wp_mgest_apicode']);

		

			$options['wp_mgest_apicode'] = $wp_mgest_apicode;

			$options['last_update'] = time();



			update_option( 'wp_mgest', $options);

		}

	}





	if($options != ''){



		if(isset($options['wp_mgest_codcliente']))

			$wp_mgest_codcliente = $options['wp_mgest_codcliente'];



		if(isset($options['wp_mgest_apicode']))

			$wp_mgest_apicode = $options['wp_mgest_apicode'];



		if(isset($options['wp_mgest_emailcontact']))

			$wp_mgest_emailcontact = $options['wp_mgest_emailcontact'];



	}

	require( 'inc/options-page-wrapper.php' );



}



class Wp_Mgest_Widget extends WP_Widget {



	function wp_mgest_widget() {

		// Instantiate the parent object

		parent::__construct( false, 'Official Multigestionale Widget' );

	}



	function widget( $args, $instance ) {

		// Widget output



		global $plugin_url;

		global $wpdb;



		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		$make = $instance['make'];

		$list = $instance['list'];

		$size = $instance['size'];

		$category = $instance['category'];

		$id = $instance['id'];

		$limit = apply_filters( 'widget_limit', $instance['limit'] );

		$sort = $instance['sort'];

		$invert = $instance['invert'];



		if($make!='0'){

			$makes = wp_mgest_get_mrmmakes();

			foreach ($makes as $key => $value) {

				if($value == $make){

					$make = $key;

				}

			}

		}

		/*if($category!='0'){

			$categories = wp_mgest_get_mrmvehicle_class();

			foreach ($categories as $key => $value) {

				if($value == $category){

					$category = $key;

				}

			}

		}*/



	    $page_link = $wpdb->get_results('SELECT ID FROM wp_posts WHERE post_content LIKE "%[wp_mgest%" AND post_parent = 0');

	

	    $page_url = get_permalink($page_link[0]->ID);



		$options = get_option('wp_mgest');



		$wp_mgest_api = wp_mgest_get_mrminfo($options['wp_mgest_codcliente'], $options['wp_mgest_apicode'],$list,$limit,$sort,$invert,$category);



		require( 'inc/widget_front-end.php' );

	}



	function update( $new_instance, $old_instance ) {

		// Save widget options



		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		$instance['make'] = strip_tags($new_instance['make']);

		$instance['list'] = strip_tags($new_instance['list']);

		$instance['size'] = strip_tags($new_instance['size']);

		$instance['category'] = strip_tags($new_instance['category']);

		$instance['id'] = strip_tags($new_instance['id']);

		$instance['limit'] = strip_tags($new_instance['limit']);

		$instance['sort'] = strip_tags($new_instance['sort']);

		$instance['invert'] = strip_tags($new_instance['invert']);



		return $instance;

	}



	function form( $instance ) {

		// Output admin widget options form



		$title = esc_attr( $instance['title'] );

		$make = esc_attr( $instance['make'] );

		$list = esc_attr( $instance['list'] );

		$size = esc_attr( $instance['size'] );

		$category = esc_attr( $instance['category'] );

		$id = esc_attr( $instance['id'] );

		$makes = wp_mgest_get_mrmmakes();

		$categories = wp_mgest_get_mrmvehicle_class();

		$limit = esc_attr( $instance['limit'] );

		$sort = esc_attr( $instance['sort'] );

		$invert = esc_attr( $instance['invert'] );



		require( 'inc/widget-fields.php' );

	}

}



function wp_mgest_register_widgets() {

	register_widget( 'Wp_Mgest_Widget' );

}



add_action( 'widgets_init', 'wp_mgest_register_widgets' );





add_action( 'wp_ajax_wpMgestSendMail', 'wp_mgest_sendMail' );

add_action( 'wp_ajax_nopriv_wpMgestSendMail', 'wp_mgest_sendMail' );

function wp_mgest_sendMail()

{

	$options = get_option('wp_mgest');



	$wp_mgest_codcliente = $options['wp_mgest_codcliente'];



	$nome 		= $_POST["nome"];

	$tel 		= $_POST["tel"];

	$email	 	= $_POST["email"];

	$messaggio 	= $_POST["messaggio"];

	$cod_cli	= $wp_mgest_codcliente;

	$image 		= $_POST['wp_mgest_image'];

	$title 		= $_POST['wp_mgest_title'];

	$price 		= $_POST['wp_mgest_price'];

	$tipologia  = $_POST['wp_mgest_tipologia'];

	$carburante  = $_POST['wp_mgest_carburante'];

	$km  		= $_POST['wp_mgest_km'];

	$immatricolazione = $_POST['wp_mgest_date'];

	$kw  		= $_POST['wp_mgest_kw'];

	$cv  		= $_POST['wp_mgest_cv'];

	$colore  		= $_POST['wp_mgest_colore'];

	$vernice  		= $_POST['wp_mgest_vernice'];

	$url		= wp_get_referer();



	$img = str_replace("big.jpg","medium.jpg",$image);

	$oggetto = 'Ci sono buone notizie, qualcuno &egrave; interessato alla tua '.$title.' '.$price.'!';

	$start_email_html = '

	<html>

	<body style="font-family: \'lucida grande\',tahoma,verdana,arial,sans-serif;font-size:12px;">';

	$email_html = 'Ciao, <br><br>

		'.$nome.' &egrave; interessato ad un tuo annuncio che ha trovato

		tramite il plugin di <b>multigestionale</b> per Wordpress e ti invia questo messaggio<br><br>

		'.$messaggio.'<br><br>

		Puoi contattare il cliente al numero: '.$tel.' o alla email: '.$email.'<br><br>

		Dati dell\'annuncio:<br><br>

		<b>'.$title.'</b><br><br>

		<table cellpadding=0 cellspacing=0 border=0 style="font-size:12px;">

			<tr>

				<td style="padding-right:10px;" valign=top><img src="'.$img.'"></td>

				<td>

				Prezzo al pubblico: <b>&euro; '.$price.'</b><br>

	                        Categoria: <b>'.$tipologia.'</b><br>

				Alimentazione: <b>'.$carburante.'</b><br>

				Chilometraggio: <b>'.$km.' km</b><br>

				Anno: <b>'.$immatricolazione.'</b><br>

				Potenza: <b>'.$kw.' kW ('.$cv.' CV)</b><br>

				Colore: <b>'.$colore.' '.$vernice.'</b><br>

				</td>

			</tr>

		</table><br>

		Clicca <a href="'.$url.'" style="color:#50A9E3;">qui</a> per visualizzare la scheda di questo annuncio.<br><br>

		Buona fortuna per la vendita di questa inserzione e non lasciarti scappare il cliente!<br><br>

		il Team di multigestionale motori<br><br>

		Email: <a href="mailto:info@mistermatic.it" style="color:#50A9E3;">info@mistermatic.it</a><br>

		Web: <a href="https://motori.multigestionale.com" style="color:#50A9E3;">https://motori.multigestionale.com</a><br><br>

		<b style="color:#4a39a6;">Multigestionale</b>

		<hr size=1>

		<span style="color:gray; font-size:10px;">

		Questa email ti &egrave; stata inviata dal plugin di <span style="color:#4a39a6;">Multigestioanle</span> per Wordpress a seguito di una tua richiesta specifica in accordo con le regole della privacy. Nel caso tu ritenga che questa email sia stata inviata per errore ti preghiamo di comunicarcelo. <b>Questa email &egrave; generata automaticamente, ti preghiamo di non rispondere a questo messaggio perch&egrave; non ci giungerebbe. Se vuoi contattarci <a href="" style="color:#50A9E3;">clicca qui</a></b> Rispondendo a questa email contatterai direttamente il cliente interessato.<br><br>

		<b>Subito 2020 &copy; tutti i diritti riservati</b>

		</span>

	</body>

	</html>';

	$headers  = "MIME-Version: 1.0\r\n";

	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";



	if(isset($options['wp_mgest_emailcontact']) && !empty($options['wp_mgest_emailcontact'])){

		$email_to = $options['wp_mgest_emailcontact'];

	}else{

		$email_to = get_bloginfo("admin_email");

	}



	if(wp_mail( $email_to, $oggetto, $start_email_html.$email_html, $headers."From: ".$nome." dal plugin Mgest per Wordpress <".$email.">" )){
		print "Messaggio inviato!";
	}else{
		print "Errore nell'invio del messaggio! Riprova!";
	}



}





function wp_mgest_shortcode( $atts, $content = null ){



	global $post;

	global $plugin_url;



	extract( shortcode_atts( array(

		'title' => '',

		'list' => '0',

		'make' => '0',

		'size' => '3',

		'category' => 'all',

		'num_ads' => '10',

		'full_numbers' => 'yes',

		'show_models' => 'no',

		'show_date' => 'no',

		'descr_len' => '100',

		'limit' => '0',

		'sort' => 'title',

		'invert' => '0',

		'visualizza' => '10,25,50,80'

		), $atts ) );



	$options = get_option('wp_mgest');



	$page_link = get_permalink();



	if(isset($options['wp_mgest_codcliente']) && !empty($options['wp_mgest_codcliente'])){



		$wp_mgest_api = wp_mgest_get_mrminfo($options['wp_mgest_codcliente'], $options['wp_mgest_apicode'], $list,$limit,$sort,$invert);



		$marche = wp_mgest_get_mrmmakes();

		$categories = wp_mgest_get_mrmvehicle_class();

		ob_start();



		require( 'inc/front-end.php' );



		$content = ob_get_clean();



		return $content;

	}else{

		return "Per creare la pagina annunci è necessario inserire il Codice Cliente Multigestione all'interno del menu Impostazioni di Wordpress, nella pagina Multigestionale Plugin. Per qualsiasi problema contattare il servizio assistenza.";

	}

}

add_shortcode( 'wp_mgest', 'wp_mgest_shortcode' );





function wp_mgest_get_mrminfo($wp_mgest_codcliente, $wp_mgest_apicode,$list = '0',$limit = '0',$sort = 'title',$invert = '0',$category='0'){

	

	if($wp_mgest_codcliente){

		$json_feed_url = 'https://motori.multigestionale.com/api/?cc='.$wp_mgest_codcliente.'&show=all&out_type=json';



		if($wp_mgest_apicode){

			$json_feed_url .= '&api_code='.$wp_mgest_apicode;

		}



		if($list == '1'){

			$json_feed_url .= '&showcase=1';

		}


		if($category != '0'){

			$json_feed_url .= '&vehicle_class='.$category;

		}



		if(!empty($limit)){
			$json_feed_url .= '&limit='.$limit;
		}

        $invert = ($invert == "1") ? "1" : "0";

		$json_feed_url .= '&sort='.$sort.'&invert='.$invert;

	}



	$args = array('timeout' => 120);



	$json_feed = wp_remote_get( $json_feed_url, $args );


	if (is_wp_error($json_feed)) {

	    return $json_feed;

	}else{

        $json_feed["body"] = (strpos($json_feed["body"], "[")  !== 0) ? "[" . $json_feed["body"] . "]" : $json_feed["body"];

        $return = json_decode($json_feed['body']);

        prepare($return);

		return $return;//json_decode($json_feed['body']);

	}
}

function prepare(&$return)
{
    for ($i = 0; $i<count($return); $i++) {
        $data = &$return[$i];
        if (property_exists($data, "images") && is_string($data->images) && (!empty($data->images))) {
            $data->images = array($data->images);
        }
    }
}





function wp_mgest_get_mrmmakes(){



	$options = get_option('wp_mgest');



	if(isset($options['wp_mgest_codcliente'])){

	

		$json_feed_url = 'http://motori.multigestionale.com/api/getObjects.php?obj=makes';



		$args = array('timeout' => 120);



		$json_feed = wp_remote_get( $json_feed_url, $args );



		if (is_wp_error($json_feed)) {

		    return $json_feed;

		}



		$json_feed = json_decode($json_feed['body']);



		$wp_mgest_api = wp_mgest_get_mrminfo($options['wp_mgest_codcliente'], $options['wp_mgest_apicode']);



		$makes = array();







		foreach ($wp_mgest_api as $value) {

			if(!array_key_exists($value->make,$makes)){

				foreach ($json_feed->objs->element as $value2) {

					if($value2->value == $value->make){

						$makes[$value->make] = $value2->key;

					}

				}

			}

		}



		$makes = array_unique($makes);



		return $makes;

	}else{

		return array('0' => 'Codice cliente mancante');

	}



}

function wp_mgest_get_mrmvehicle_class(){



	$options = get_option('wp_mgest');



	if(isset($options['wp_mgest_codcliente'])){

	

		$json_feed_url = 'https://motori.multigestionale.com/api/getObjects.php?obj=vehicle_class&out_type=json';



		$args = array('timeout' => 120);



		$json_feed = wp_remote_get( $json_feed_url, $args );



		if (is_wp_error($json_feed)) {

		    return $json_feed;

		}



		$json_feed = json_decode($json_feed['body']);



		$wp_mgest_api = wp_mgest_get_mrminfo($options['wp_mgest_codcliente'], $options['wp_mgest_apicode']);



		$categories = array();







		foreach ($wp_mgest_api as $value) {

			if(!array_key_exists($value->vehicle_class,$categories)){

				foreach ($json_feed->objs->element as $value2) {

					if($value2->value == $value->vehicle_class){

						$categories[$value->vehicle_class] = $value2->key;

					}

				}

			}

		}



		$categories = array_unique($categories);



		return $categories;

	}else{

		return array('0' => 'Codice cliente mancante');

	}



}



function wp_mgest_backend_styles(){



	wp_enqueue_style( 'wp_mgest_backend_css', plugins_url( 'wp_mgest/css/wp_mgest.css'));

}

add_action( 'admin_head','wp_mgest_backend_styles');



function add_ajaxurl_cdata_to_front(){ ?>

    <script type="text/javascript"> //<![CDATA[

        ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
        plugin_url = '<?php echo WP_PLUGIN_URL . "/wp_mgest"; ?>';

    //]]> </script>

<?php }

add_action( 'wp_head', 'add_ajaxurl_cdata_to_front', 1);



function wp_mgest_frontend_script_and_styles(){



	wp_enqueue_style( 'wp_mgest_frontend_css', plugins_url( 'wp_mgest/css/wp_mgest.css'));

	//wp_enqueue_script( 'wp_mgest_jquery-1.11.1.min.js', plugins_url( 'wp_mgest/js/wp_mgest_jquery-1.11.1.min.js'), array('jquery'), '', true);

	wp_enqueue_script( 'wp_mgest_frontend_js', plugins_url( 'wp_mgest/js/wp_mgest.js'), array('jquery'), '', true);

}

add_action( 'wp_enqueue_scripts','wp_mgest_frontend_script_and_styles');

add_action('init', 'wptuts_activate_au');
function wptuts_activate_au()
{
    require_once ('wp_autoupdate.php');
    $wptuts_plugin_current_version = '2.3';
    $wptuts_plugin_remote_path = 'https://motori.multigestionale.com/public/mgest/mgest/plugin_wp/update.php';
    $wptuts_plugin_slug = plugin_basename(__FILE__);
    new wp_auto_update ($wptuts_plugin_current_version, $wptuts_plugin_remote_path, $wptuts_plugin_slug);
}



?>