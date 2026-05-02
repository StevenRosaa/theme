function wpMgestsendMail(){

	var nome = document.getElementById('nome').value;
	var email = document.getElementById('email').value;
	var telefono = document.getElementById('tel').value;
	var messaggio = document.getElementById('messaggio').value;
	var privacy = document.getElementById('privacycheck').checked;
	var wp_mgest_image = document.getElementById('wp_mgest_image').value;
	var wp_mgest_title = document.getElementById('wp_mgest_title').value;
	var wp_mgest_price = document.getElementById('wp_mgest_price').value;
	var wp_mgest_tipologia = document.getElementById('wp_mgest_tipologia').value;
	var wp_mgest_carburante = document.getElementById('wp_mgest_carburante').value;
	var wp_mgest_km = document.getElementById('wp_mgest_km').value;
	var wp_mgest_date = document.getElementById('wp_mgest_date').value;
	var wp_mgest_kw = document.getElementById('wp_mgest_kw').value;
	var wp_mgest_cv = document.getElementById('wp_mgest_cv').value;
	var wp_mgest_colore = document.getElementById('wp_mgest_colore').value;
	var wp_mgest_vernice = document.getElementById('wp_mgest_vernice').value;

	if(nome && telefono && (email.indexOf("@") != "-1") && messaggio){
		if(privacy){
			document.getElementById('wp_mgest_report').innerHTML = "Invio in corso <img src='"+plugin_url+"/images/loader01.gif' width='50px;'>";
			jQuery.post(
			    ajaxurl, 
			    {
			        'action': 'wpMgestSendMail',
			        'nome': nome,
			        'tel': telefono,
			        'email': email,
			        'messaggio': messaggio,
			        'wp_mgest_image': wp_mgest_image,
			        'wp_mgest_title': wp_mgest_title,
			        'wp_mgest_price': wp_mgest_price,
			        'wp_mgest_tipologia': wp_mgest_tipologia,
			        'wp_mgest_carburante': wp_mgest_carburante,
			        'wp_mgest_km': wp_mgest_km,
			        'wp_mgest_date': wp_mgest_date,
			        'wp_mgest_kw': wp_mgest_kw,
			        'wp_mgest_cv': wp_mgest_cv,
			        'wp_mgest_colore': wp_mgest_colore,
			        'wp_mgest_vernice': wp_mgest_vernice
			    }, 
			    function(response){
			        document.getElementById('wp_mgest_report').innerHTML = response.replace("0","");
			    }
			);
		}else{
			document.getElementById('wp_mgest_report').innerHTML = "Accetta le condizioni";
		}
	}else{
		document.getElementById('wp_mgest_report').innerHTML = "Compila correttamente i campi";
	}
}