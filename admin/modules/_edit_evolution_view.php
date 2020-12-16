<?

	$db = new Database();

	$e = array();
	if ($data[s] != "" && $data[e] != ""){
		$e = $db->select("vms_specie_has_evolutions", "WHERE specie = '$data[s]' AND evolution = '$data[e]'");
	} else if ($data[s] != ""){
		$e = $db->select("vms_specie_has_evolutions", "WHERE specie = '$data[s]' ORDER BY specie ASC, evolution ASC LIMIT 1");
	} else {
		$e = $db->select("vms_specie_has_evolutions", "ORDER BY specie ASC, evolution ASC LIMIT 1");
	}

	$evo = mysqli_fetch_array($e, MYSQLI_ASSOC);

	$species = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");

	$evolutions = $db->sql("SELECT s.* FROM vms_species s, vms_specie_has_evolutions se WHERE se.specie = '$evo[specie]' AND s.id = se.evolution ORDER BY orderr ASC, name ASC");

?>
<script type="text/javascript">
	function specieChanged() {
		location.href='../dashboard?o=ev&s='+selspecie.value;
	}

	function evoChanged() {
		location.href='../dashboard?o=ev&s='+selspecie.value+'&e='+selevo.value;
	}
</script>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Editar evolução</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
  	<div class="row">
      <section class="col-lg-12">


		<label>Digimon</label>
		<select id="selspecie" onchange="specieChanged()">
			<? 
			$last = "";
			$current = "";
			while($s = mysqli_fetch_array($species, MYSQLI_ASSOC)) { 
				$current = $s[level];

				if ($current != $last) { ?>
					<option disabled>-------------------------<?=$current?></option>
			<? } ?>
					<option value="<?=$s['id']?>" <? if ($evo[specie] == $s['id']) { ?> selected <? } ?>><?=$s['name']?></option>
				<? 

				$last = $s[level];
			} ?>
		</select>
		<br><br>
		<label>Evolution</label>
		<select id="selevo" onchange="evoChanged()">
			<? 
			$last = "";
			$current = "";
			while($s = mysqli_fetch_array($evolutions, MYSQLI_ASSOC)) { 
				$current = $s[level];

				if ($current != $last) { ?>
					<option disabled>-------------------------<?=$current?></option>
			<? } ?>
					<option value="<?=$s['id']?>" <? if ($evo[evolution] == $s['id']) { ?> selected <? } ?>><?=$s['name']?></option>
				<? 

				$last = $s[level];
			} ?>
		</select>
		<br><br>
	<form method="POST" action="../modules/_edit_evolution_submit.php">
		<input type="hidden" name="id" value="<?=$evo[id]?>">
		<label>data_neutral (neutro)</label>
		<input type="number" name="data_neutral" value="<?=$evo[data_neutral]?>" placeholder="10">
		<br><br>
		<label>data_courage (dragões)</label>
		<input type="number" name="data_courage" value="<?=$evo[data_courage]?>" placeholder="10">
		<br><br>
		<label>data_friendship (feras)</label>
		<input type="number" name="data_friendship" value="<?=$evo[data_friendship]?>" placeholder="10">
		<br><br>
		<label>data_love (passaros)</label>
		<input type="number" name="data_love" value="<?=$evo[data_love]?>" placeholder="10">
		<br><br>
		<label>data_knowledge (insetos)</label>
		<input type="number" name="data_knowledge" value="<?=$evo[data_knowledge]?>" placeholder="10">
		<br><br>
		<label>data_sincerity (plantas)</label>
		<input type="number" name="data_sincerity" value="<?=$evo[data_sincerity]?>" placeholder="10">
		<br><br>
		<label>data_reliability (peixes)</label>
		<input type="number" name="data_reliability" value="<?=$evo[data_reliability]?>" placeholder="10">
		<br><br>
		<label>data_hope (metal)</label>
		<input type="number" name="data_hope" value="<?=$evo[data_hope]?>" placeholder="10">
		<br><br>
		<label>data_light (divinos)</label>
		<input type="number" name="data_light" value="<?=$evo[data_light]?>" placeholder="10">
		<br><br>
		<label>data_kindness (virus)</label>
		<input type="number" name="data_kindness" value="<?=$evo[data_kindness]?>" placeholder="10">
		<br><br>
		<label>data_destiny (data) </label>
		<input type="number" name="data_destiny" value="<?=$evo[data_destiny]?>" placeholder="10">
		<br><br>
		<label>data_miracles (vacina) </label>
		<input type="number" name="data_miracles" value="<?=$evo[data_miracles]?>" placeholder="10">
		<br><br>
		<input type="submit" name="SALVAR" value="SALVAR"> ou 
		<input type="button" name="EXCLUIR" value="EXCLUIR" onclick="location.href='../modules/_delete_evolution_submit.php?i=<?=$evo[id]?>'">
	</form>
      </section>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>