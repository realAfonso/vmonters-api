<?

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../../class/connection.php");
	include("../../../class/database.php");

	$db = new Database();

	$species = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");

	$evolutions = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");

?>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
</head>
<body style="padding: 50px;">
	<form method="POST" action="_submit.php">
		<h1>Criar evolução</h1>
		<hr><br>
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
		<br><br><hr><br>
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
		<br><br><hr><br>
		<input type="submit" name="CADASTRAR" value="CADASTRAR">
	</form>
</body>