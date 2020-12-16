<?

	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set("America/Recife");

	include("../../../class/connection.php");
	include("../../../class/database.php");

	$dados = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$db = new Database();

	$species = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");

	if ($dados[m] != ""){
		$m = $db->select("vms_species", "WHERE id = $dados[m]");
	} else {
		$m = $db->select("vms_species", "ORDER BY orderr ASC, name ASC LIMIT 1");
	}
	$monster = mysqli_fetch_array($m, MYSQLI_ASSOC);

?>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
</head>
<script type="text/javascript">
	function specieChanged() {
		location.href = "../edit?m="+specie.value;
	}

	function levelChanged() {
		if(level.value == "BABY"){
			orderr.value = 1;
			statusNumber.innerHTML = "60";
			ajustStats(60);
		}
		if(level.value == "INTRAINING"){
			orderr.value = 2;
			statusNumber.innerHTML = "120";
			ajustStats(120);
		}
		if(level.value == "ROOKIE"){
			orderr.value = 3;
			statusNumber.innerHTML = "240";
			ajustStats(240);
		}
		if(level.value == "CHAMPION"){
			orderr.value = 4;
			statusNumber.innerHTML = "480";
			ajustStats(480);
		}
		if(level.value == "ARMOR"){
			orderr.value = 5;
			statusNumber.innerHTML = "720";
			ajustStats(720);
		}
		if(level.value == "ULTIMATE"){
			orderr.value = 6;
			statusNumber.innerHTML = "960";
			ajustStats(960);
		}
		if(level.value == "MEGA"){
			orderr.value = 7;
			statusNumber.innerHTML = "1920";
			ajustStats(1920);
		}
		if(level.value == "PERFECT"){
			orderr.value = 8;
			statusNumber.innerHTML = "3840";
			ajustStats(3840);
		}
	}

	function levelAjust() {
		if(level.value == "BABY"){
			orderr.value = 1;
			statusNumber.innerHTML = "60";
		}
		if(level.value == "INTRAINING"){
			orderr.value = 2;
			statusNumber.innerHTML = "120";
		}
		if(level.value == "ROOKIE"){
			orderr.value = 3;
			statusNumber.innerHTML = "240";
		}
		if(level.value == "CHAMPION"){
			orderr.value = 4;
			statusNumber.innerHTML = "480";
		}
		if(level.value == "ARMOR"){
			orderr.value = 5;
			statusNumber.innerHTML = "720";
		}
		if(level.value == "ULTIMATE"){
			orderr.value = 6;
			statusNumber.innerHTML = "960";
		}
		if(level.value == "MEGA"){
			orderr.value = 7;
			statusNumber.innerHTML = "1920";
		}
		if(level.value == "PERFECT"){
			orderr.value = 8;
			statusNumber.innerHTML = "3840";
		}
	}

	function ajustStats(num) {
		var part = num/6;
		hp.value = part;
		atk.value = part;
		def.value = part;
		spatk.value = part;
		spdef.value = part;
		spd.value = part;

		calcStats();
	}

	function calcStats() {
		var calc = parseInt(hp.value) + 
			parseInt(atk.value) + 
			parseInt(def.value) + 
			parseInt(spatk.value) + 
			parseInt(spdef.value) + 
			parseInt(spd.value);
		statusCalc.innerHTML = calc;
	}
</script>
<body style="padding: 50px;">
	<form method="POST" action="_submit.php" enctype="multipart/form-data">
		<h1>Editar Digimon</h1>
		<label>Digimon</label>
		<select name="id" id="specie" onchange="specieChanged()">
			<? 
			$last = "";
			$current = "";
			while($s = mysqli_fetch_array($species, MYSQLI_ASSOC)) { 
				$current = $s[level];

				if ($current != $last) { ?>
					<option disabled>-------------------------<?=$current?></option>
			<? } ?>
					<option value="<?=$s['id']?>" <? if ($dados[m] == $s['id']) { ?> selected <? } ?>><?=$s['name']?></option>
				<? 

				$last = $s[level];
			} ?>
		</select>
		<br><br><hr><br>
		<label>Name</label>
		<input type="text" name="name" placeholder="Nome" value="<?=$monster[name]?>">
		<br><br>
		<label>Description</label><br>
		<textarea name="description" maxlength="500" rows="8" style="width: 600px;"><?=$monster[description]?></textarea> 
		<br><br>
		<label>Imagem (se quiser uma nova)</label><br>
		<input type="file" name="image">
		<input type="hidden" name="aimage" value="../../../assets/species/<?=$monster[image]?>">
		<br><br>
		<label>Level</label>
		<select name="level" id="level" onchange="levelChanged()">
			<option value="BABY" <? if ($monster[level] == "BABY") { ?> selected <? } ?>>BABY</option>
			<option value="INTRAINING" <? if ($monster[level] == "INTRAINING") { ?> selected <? } ?>>IN-TRAINING</option>
			<option value="ROOKIE" <? if ($monster[level] == "ROOKIE") { ?> selected <? } ?>>ROOKIE</option>
			<option value="CHAMPION" <? if ($monster[level] == "CHAMPION") { ?> selected <? } ?>>CHAMPION</option>
			<option value="ARMOR" <? if ($monster[level] == "ARMOR") { ?> selected <? } ?>>ARMOR</option>
			<option value="ULTIMATE" <? if ($monster[level] == "ULTIMATE") { ?> selected <? } ?>>ULTIMATE</option>
			<option value="MEGA" <? if ($monster[level] == "MEGA") { ?> selected <? } ?>>MEGA</option>
			<option value="PERFECT" <? if ($monster[level] == "PERFECT") { ?> selected <? } ?>>PERFECT</option>
		</select>
		<input type="hidden" name="orderr" id="orderr" value="<?=$monster[orderr]?>">
		<br><br>
		<label>Atributo</label>
		<select name="attribute">
			<option value="DATA" <? if ($monster[attribute] == "DATA") { ?> selected <? } ?>>DATA</option>
			<option value="VIRUS" <? if ($monster[attribute] == "VIRUS") { ?> selected <? } ?>>VIRUS</option>
			<option value="VACCINE" <? if ($monster[attribute] == "VACCINE") { ?> selected <? } ?>>VACCINE</option>
		</select>
		<br><br>
		<label>Tipo 1</label>
		<select name="type1">
			<option value="NEUTRAL" <? if ($monster[type1] == "NEUTRAL") { ?> selected <? } ?>>NEUTRAL</option>
			<option value="FIRE" <? if ($monster[type1] == "FIRE") { ?> selected <? } ?>>FIRE</option>
			<option value="LIGHT" <? if ($monster[type1] == "LIGHT") { ?> selected <? } ?>>LIGHT</option>
			<option value="THUNDER" <? if ($monster[type1] == "THUNDER") { ?> selected <? } ?>>THUNDER</option>
			<option value="WIND" <? if ($monster[type1] == "WIND") { ?> selected <? } ?>>WIND</option>
			<option value="ICE" <? if ($monster[type1] == "ICE") { ?> selected <? } ?>>ICE</option>
			<option value="DARK" <? if ($monster[type1] == "DARK") { ?> selected <? } ?>>DARK</option>
			<option value="GROUND" <? if ($monster[type1] == "GROUND") { ?> selected <? } ?>>GROUND</option>
			<option value="WOOD" <? if ($monster[type1] == "WOOD") { ?> selected <? } ?>>WOOD</option>
			<option value="WATER" <? if ($monster[type1] == "WATER") { ?> selected <? } ?>>WATER</option>
			<option value="STEEL" <? if ($monster[type1] == "STEEL") { ?> selected <? } ?>>STEEL</option>
		</select>
		<br><br>
		<label>Tipo 2</label>
		<select name="type2">
			<option value="NONE" <? if ($monster[type2] == null) { ?> selected <? } ?>>N/A</option>
			<option value="NEUTRAL" <? if ($monster[type2] == "NEUTRAL") { ?> selected <? } ?>>NEUTRAL</option>
			<option value="FIRE" <? if ($monster[type2] == "FIRE") { ?> selected <? } ?>>FIRE</option>
			<option value="LIGHT" <? if ($monster[type2] == "LIGHT") { ?> selected <? } ?>>LIGHT</option>
			<option value="THUNDER" <? if ($monster[type2] == "THUNDER") { ?> selected <? } ?>>THUNDER</option>
			<option value="WIND" <? if ($monster[type2] == "WIND") { ?> selected <? } ?>>WIND</option>
			<option value="ICE" <? if ($monster[type2] == "ICE") { ?> selected <? } ?>>ICE</option>
			<option value="DARK" <? if ($monster[type2] == "DARK") { ?> selected <? } ?>>DARK</option>
			<option value="GROUND" <? if ($monster[type2] == "GROUND") { ?> selected <? } ?>>GROUND</option>
			<option value="WOOD" <? if ($monster[type2] == "WOOD") { ?> selected <? } ?>>WOOD</option>
			<option value="WATER" <? if ($monster[type2] == "WATER") { ?> selected <? } ?>>WATER</option>
			<option value="STEEL" <? if ($monster[type2] == "STEEL") { ?> selected <? } ?>>STEEL</option>
		</select>
		<br><br>
		<h2><span id="statusCalc">60</span> / <span id="statusNumber">60</span></h2>
		<br>
		<label>HP</label>
		<input type="number" name="hp" id="hp" value="<?=$monster[hp]?>" onkeyup="calcStats()">
		<br><br>
		<label>ATK</label>
		<input type="number" name="atk" id="atk" value="<?=$monster[atk]?>" onkeyup="calcStats()">
		<br><br>
		<label>DEF</label>
		<input type="number" name="def" id="def" value="<?=$monster[def]?>" onkeyup="calcStats()">
		<br><br>
		<label>Sp.ATK</label>
		<input type="number" name="spatk" id="spatk" value="<?=$monster[spatk]?>" onkeyup="calcStats()">
		<br><br>
		<label>Sp.DEF</label>
		<input type="number" name="spdef" id="spdef" value="<?=$monster[spdef]?>" onkeyup="calcStats()">
		<br><br>
		<label>SPD</label>
		<input type="number" name="spd" id="spd" value="<?=$monster[spd]?>" onkeyup="calcStats()">
		<br><br>
		<label>Rarity</label>
		<select name="rarity">
			<option value="COMMON" <? if ($monster[rarity] == "COMMON") { ?> selected <? } ?>>COMMON</option>
			<option value="UNCOMMON" <? if ($monster[rarity] == "UNCOMMON") { ?> selected <? } ?>>UNCOMMON</option>
			<option value="RARE" <? if ($monster[rarity] == "RARE") { ?> selected <? } ?>>RARE</option>
			<option value="ULTRARARE" <? if ($monster[rarity] == "ULTRARARE") { ?> selected <? } ?>>ULTRARARE</option>
		</select>
		<br><br>
		<input type="submit" name="CADASTRAR">
	</form>
</body>
<script type="text/javascript">
	levelAjust();
	calcStats();
</script>