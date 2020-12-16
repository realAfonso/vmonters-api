<?

  $db = new Database();

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Nova espécie</h1>
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

  	<? if($data[m] != "") { ?>

  	<div class="row">
  		<section class="col-lg-12">
  			<? if($data[m] == "e") { ?>
  			<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Erro!</h5>
              Erro ao cadastrar Digimon. Verifique os dados e tente novamente!
            </div>
            <? } else if($data[m] == "s") { ?>
	  		<div class="alert alert-success alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
	          Digimon cadastrado com sucesso!
	        </div>
	    	<? } ?>
	    </section>
  	</div>

  	<? } ?>

    <div class="row">
      <section class="col-lg-12">

        <div class="card">
          <div class="card-body">

          	<form method="POST" action="../modules/_new_specie_submit.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-9">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Nome *</label>
                    <input type="text" name="name" class="form-control" placeholder="Agumon" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Raridade</label>
                    <select class="form-control" name="rarity">
						<option value="COMMON">COMMON</option>
						<option value="UNCOMMON">UNCOMMON</option>
						<option value="RARE">RARE</option>
						<option value="ULTRARARE">ULTRARARE</option>
                    </select>
                  </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <!-- textarea -->
                  <div class="form-group">
                    <label>Descrição *</label>
                    <textarea class="form-control" name="description" rows="5" maxlength="500" placeholder="Um Digimon dinossáuro com ataques de fogo..."></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="monsterImage" name="image" required>
                      <label class="custom-file-label" for="monsterImage">Escolha a imagem...</label>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Nível *</label>
                    <select class="form-control" name="level" id="level" onchange="levelChanged()">
						<option value="BABY">BABY</option>
						<option value="INTRAINING">IN-TRAINING</option>
						<option value="ROOKIE">ROOKIE</option>
						<option value="CHAMPION">CHAMPION</option>
						<option value="ARMOR">ARMOR</option>
						<option value="ULTIMATE">ULTIMATE</option>
						<option value="MEGA">MEGA</option>
						<option value="ULTRA">ULTRA</option>
                    </select>
                  </div>
                  </div>
                </div>

				<input type="hidden" name="orderr" id="orderr" value="1">

                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Atributo *</label>
                    <select class="form-control" name="attribute">
						<option value="DATA">DATA</option>
						<option value="VIRUS">VIRUS</option>
						<option value="VACCINE">VACCINE</option>
                    </select>
                  </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Tipo 1 *</label>
                    <select class="form-control" name="type1">
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
                  </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Tipo 2</label>
                    <select class="form-control" name="type2">
						<option value="NONE" selected disabled>N/A</option>
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
                  </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Total de status</label>
                    <input type="text" class="form-control" id="statusCalc" value="60" disabled>
                  </div>
                </div>
                <div class="col-sm-6">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Status sugerido</label>
                    <input type="text" class="form-control" id="statusNumber" value="60" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>HP *</label>
                    <input type="number" class="form-control" name="hp" id="hp" value="10" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>ATK *</label>
                    <input type="number" class="form-control" name="atk" id="atk" value="10" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>DEF *</label>
                    <input type="number" class="form-control" name="def" id="def" value="10" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>SP.ATK *</label>
                    <input type="number" class="form-control" name="spatk" id="spatk" value="10" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>SP.DEF *</label>
                    <input type="number" class="form-control" name="spdef" id="spdef" value="10" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>SPD *</label>
                    <input type="number" class="form-control" name="spd" id="spd" value="10" onkeyup="calcStats()" required>
                  </div>
                </div>
              </div>

          	</div>

              <div class="card-footer">
	              <button type="submit" name="CADASTRAR" class="btn btn-primary">Cadastrar</button>
	            </div>
            </form>
          <!-- /.card-body -->
        </div>
      </section>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>

<script type="text/javascript">
	function levelChanged() {
		if(level.value == "BABY"){
			orderr.value = 1;
			statusNumber.value = "60";
			ajustStats(60);
		}
		if(level.value == "INTRAINING"){
			orderr.value = 2;
			statusNumber.value = "120";
			ajustStats(120);
		}
		if(level.value == "ROOKIE"){
			orderr.value = 3;
			statusNumber.value = "240";
			ajustStats(240);
		}
		if(level.value == "CHAMPION"){
			orderr.value = 4;
			statusNumber.value = "480";
			ajustStats(480);
		}
		if(level.value == "ARMOR"){
			orderr.value = 5;
			statusNumber.value = "720";
			ajustStats(720);
		}
		if(level.value == "ULTIMATE"){
			orderr.value = 6;
			statusNumber.value = "960";
			ajustStats(960);
		}
		if(level.value == "MEGA"){
			orderr.value = 7;
			statusNumber.value = "1920";
			ajustStats(1920);
		}
		if(level.value == "ULTRA"){
			orderr.value = 8;
			statusNumber.value = "3840";
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
		statusCalc.value = calc;
	}
</script>