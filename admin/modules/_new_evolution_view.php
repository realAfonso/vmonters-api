<?

	$db = new Database();

	$species = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");

	$evolutions = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Nova evolução</h1>
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

	<form method="POST" action="../modules/_new_evolution_submit.php">
		<label>Digimon</label>
		<select name="specie">
			<? 
			$last = "";
			$current = "";
			while($s = mysqli_fetch_array($species, MYSQLI_ASSOC)) { 
				$current = $s[level];

				if ($current != $last) { ?>
					<option disabled>-------------------------<?=$current?></option>
			<? } ?>
					<option value="<?=$s['id']?>"><?=$s['name']?></option>
				<? 

				$last = $s[level];
			} ?>
		</select>
		<br><br>
		<label>Evolution</label>
		<select name="evolution">
			<? 
			$last = "";
			$current = "";
			while($s = mysqli_fetch_array($evolutions, MYSQLI_ASSOC)) { 
				$current = $s[level];

				if ($current != $last) { ?>
					<option disabled>-------------------------<?=$current?></option>
			<? } ?>
					<option value="<?=$s['id']?>"><?=$s['name']?></option>
				<? 

				$last = $s[level];
			} ?>
		</select>
		<br><br>
		<label>data_neutral (neutro)</label>
		<input type="number" name="data_neutral" placeholder="10">
		<br><br>
		<label>data_courage (dragões)</label>
		<input type="number" name="data_courage" placeholder="10">
		<br><br>
		<label>data_friendship (feras)</label>
		<input type="number" name="data_friendship" placeholder="10">
		<br><br>
		<label>data_love (passaros)</label>
		<input type="number" name="data_love" placeholder="10">
		<br><br>
		<label>data_knowledge (insetos)</label>
		<input type="number" name="data_knowledge" placeholder="10">
		<br><br>
		<label>data_sincerity (plantas)</label>
		<input type="number" name="data_sincerity" placeholder="10">
		<br><br>
		<label>data_reliability (peixes)</label>
		<input type="number" name="data_reliability" placeholder="10">
		<br><br>
		<label>data_hope (metal)</label>
		<input type="number" name="data_hope" placeholder="10">
		<br><br>
		<label>data_light (divinos)</label>
		<input type="number" name="data_light" placeholder="10">
		<br><br>
		<label>data_kindness (virus)</label>
		<input type="number" name="data_kindness" placeholder="10">
		<br><br>
		<label>data_destiny (data) </label>
		<input type="number" name="data_destiny" placeholder="10">
		<br><br>
		<label>data_miracles (vacina) </label>
		<input type="number" name="data_miracles" placeholder="10">
		<br><br>
		<input type="submit" name="CADASTRAR" value="CADASTRAR">
	</form>
      </section>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>