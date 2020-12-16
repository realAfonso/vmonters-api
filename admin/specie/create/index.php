<head>
	<title>Admin</title>
	<meta charset="utf-8">
</head>
<script type="text/javascript">
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
		<h1>Criar novo Digimon</h1>
		<hr><br>
		<label>Name</label>
		<input type="text" name="name" placeholder="Nome">
		<br><br>
		<label>Description</label><br>
		<textarea name="description" maxlength="500" rows="5" style="width: 500px;"></textarea> 
		<br><br>
		<label>Image</label>
		<input type="file" name="image">
		<br><br>
		<label>Level</label>
		<select name="level" id="level" onchange="levelChanged()">
			<option value="BABY">BABY</option>
			<option value="INTRAINING">IN-TRAINING</option>
			<option value="ROOKIE">ROOKIE</option>
			<option value="CHAMPION">CHAMPION</option>
			<option value="ARMOR">ARMOR</option>
			<option value="ULTIMATE">ULTIMATE</option>
			<option value="MEGA">MEGA</option>
			<option value="PERFECT">PERFECT</option>
		</select>
		<input type="hidden" name="orderr" id="orderr" value="1">
		<br><br>
		<label>Atributo</label>
		<select name="attribute">
			<option value="DATA">DATA</option>
			<option value="VIRUS">VIRUS</option>
			<option value="VACCINE">VACCINE</option>
		</select>
		<br><br>
		<label>Tipo 1</label>
		<select name="type1">
			<option value="NEUTRAL">NEUTRAL</option>
			<option value="FIRE">FIRE</option>
			<option value="LIGHT">LIGHT</option>
			<option value="THUNDER">THUNDER</option>
			<option value="WIND">WIND</option>
			<option value="ICE">ICE</option>
			<option value="DARK">DARK</option>
			<option value="GROUND">GROUND</option>
			<option value="WOOD">WOOD</option>
			<option value="WATER">WATER</option>
			<option value="STEEL">STEEL</option>
		</select>
		<br><br>
		<label>Tipo 2</label>
		<select name="type2">
			<option value="NONE">N/A</option>
			<option value="NEUTRAL">NEUTRAL</option>
			<option value="FIRE">FIRE</option>
			<option value="LIGHT">LIGHT</option>
			<option value="THUNDER">THUNDER</option>
			<option value="WIND">WIND</option>
			<option value="ICE">ICE</option>
			<option value="DARK">DARK</option>
			<option value="GROUND">GROUND</option>
			<option value="WOOD">WOOD</option>
			<option value="WATER">WATER</option>
			<option value="STEEL">STEEL</option>
		</select>
		<br><br>
		<h2><span id="statusCalc">60</span> / <span id="statusNumber">60</span></h2>
		<br>
		<label>HP</label>
		<input type="number" name="hp" id="hp" value="10" onkeyup="calcStats()">
		<br><br>
		<label>ATK</label>
		<input type="number" name="atk" id="atk" value="10" onkeyup="calcStats()">
		<br><br>
		<label>DEF</label>
		<input type="number" name="def" id="def" value="10" onkeyup="calcStats()">
		<br><br>
		<label>Sp.ATK</label>
		<input type="number" name="spatk" id="spatk" value="10" onkeyup="calcStats()">
		<br><br>
		<label>Sp.DEF</label>
		<input type="number" name="spdef" id="spdef" value="10" onkeyup="calcStats()">
		<br><br>
		<label>SPD</label>
		<input type="number" name="spd" id="spd" value="10" onkeyup="calcStats()">
		<br><br>
		<label>Rarity</label>
		<select name="rarity">
			<option value="COMMON">COMMON</option>
			<option value="UNCOMMON">UNCOMMON</option>
			<option value="RARE">RARE</option>
			<option value="ULTRARARE">ULTRARARE</option>
		</select>
		<br><br>
		<input type="submit" name="CADASTRAR">
	</form>
</body>