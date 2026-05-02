<p>

	<label>Nome del Widget</label>

	<input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />

</p>



<p>

	<label>Marca</label>

	<select name="<?php echo $this->get_field_name('make'); ?>" id="<?php echo $this->get_field_name('make'); ?>">

		<?php 

		if(!$make){

			echo '<option selected="selected" value="0">Tutte</option>';

			foreach($makes as $nome => $key){

				echo '<option value="'.$key.'">'.$nome.'</option>';

			}

		}else{

			echo '<option value="0">Tutte</option>';

			foreach($makes as $nome => $key){

				echo '<option value="'.$key.'"';

				if ($key == $make)

					echo ' selected="selected"';

				echo '>'.$nome.'</option>';

			}

		}?>

	</select>

	-

	<label>Categoria</label>

	<select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_name('category'); ?>">

		<?php 

		if(!$category){

			echo '<option selected="selected" value="0">Tutte</option>';

			foreach($categories as $nome => $key){

				echo '<option value="'.$key.'">'.$nome.'</option>';

			}

		}else{

			echo '<option value="0">Tutte</option>';

			foreach($categories as $nome => $key){

				echo '<option value="'.$key.'"';

				if ($key == $category)

					echo ' selected="selected"';

				echo '>'.$nome.'</option>';

			}

		}?>

	</select>

	-

	<label>Lista</label>

	<select name="<?php echo $this->get_field_name('list'); ?>" id="<?php echo $this->get_field_name('list'); ?>">

		<?php 

		if(!$list){

			echo '<option selected="selected" value="0">Tutte</option>';

			echo '<option value="1">Vetrina</option>';

		}else{

			if($list=='0'){

				echo '<option selected="selected" value="0">Tutte</option>';

				echo '<option value="1">Vetrina</option>';

			}else{

				if($list=='1'){

					echo '<option value="0">Tutte</option>';

					echo '<option selected="selected" value="1">Vetrina</option>';

				}

			}

		}?>

	</select>

	-

	<label>Tipo</label>

	<select name="<?php echo $this->get_field_name('size'); ?>" id="<?php echo $this->get_field_name('size'); ?>">

		<?php 

		if(!$size){

			echo '<option selected="selected" value="1">1</option>';

			echo '<option selected="selected" value="2">2</option>';

			echo '<option selected="selected" value="4">3</option>';

			echo '<option selected="selected" value="6">4</option>';

		}else{

				echo '<option value="1"';

				if ($size == "1")

					echo ' selected="selected"';

				echo '>1</option>';

				echo '<option value="2"';

				if ($size == "2")

					echo ' selected="selected"';

				echo '>2</option>';

				echo '<option value="4"';

				if ($size == "4")

					echo ' selected="selected"';

				echo '>3</option>';

				echo '<option value="6"';

				if ($size == "6")

					echo ' selected="selected"';

				echo '>4</option>';

		}?>

	</select>

	-

	<label>Max</label>

	<input size="3" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />

	-

	<label>Ordina</label>

	<select name="<?php echo $this->get_field_name('sort'); ?>" id="<?php echo $this->get_field_name('sort'); ?>">

		<?php 

		$arr_sort = array('title' => 'Nome', 'first_registration_date' => 'Immatricolazione', 'insertion_date' => 'Inserimento', 'price' => 'Prezzo', 'mileage' => 'Km', 'power_kw' => 'Potenza');

		foreach($arr_sort as $key => $value){

			echo '<option value="'.$key.'"';

			if ($sort == $key)

				echo ' selected="selected"';

			echo '>'.$value.'</option>';

		}

		?>

	</select>

	-

	<label>Inverti</label>

	<input type="checkbox" name="<?php echo $this->get_field_name('invert'); ?>" value="1" <?php if($invert == '1') echo 'checked="checked"'; ?> />

</p>



