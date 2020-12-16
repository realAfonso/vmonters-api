<?

  $db = new Database();

  $species = $db->select("vms_species", "ORDER BY orderr ASC, name ASC");

  if ($data[i] != ""){
    $m = $db->select("vms_species", "WHERE id = $data[i]");
  } else {
    $m = $db->select("vms_species", "ORDER BY orderr ASC, name ASC LIMIT 1");
  }
  $monster = mysqli_fetch_array($m, MYSQLI_ASSOC);

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Editar espécie</h1>
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

  	<? if($data[m] != "" || $data[d] != "") { ?>

  	<div class="row">
  		<section class="col-lg-12">
  			<? if($data[m] == "e") { ?>
  			<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Erro!</h5>
              Erro ao salvar Digimon. Verifique os dados e tente novamente!
            </div>
            <? } else if($data[m] == "s") { ?>
	  		<div class="alert alert-success alert-dismissible">
	          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	          <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
	          Digimon editado com sucesso!
	        </div>
	    	<? } ?>

        <? if($data[d] == "e") { ?>
        <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-ban"></i> Erro ao excluir!</h5>
              Erro ao excluir Digimon. Tente novamente mais tarde!
            </div>
            <? } else if($data[d] == "s") { ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Excluído!</h5>
            Digimon excluído com sucesso!
          </div>
        <? } ?>
	    </section>
  	</div>

  	<? } ?>

    <div class="row">
      <section class="col-lg-12">
<form method="POST" action="../modules/_edit_specie_submit.php" enctype="multipart/form-data">
        <div class="card">
          <div class="card-body">
              <div class="col-sm-12">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Espécie</label>
                    <select class="form-control" name="id" id="specie" onchange="specieChanged()">
                      <? 
                      $last = "";
                      $current = "";
                      while($s = mysqli_fetch_array($species, MYSQLI_ASSOC)) { 
                        $current = $s[level];

                        if ($current != $last) { ?>
                          <option disabled>-------------------------<?=$current?></option>
                      <? } ?>
                          <option value="<?=$s['id']?>" <? if ($data[i] == $s['id']) { ?> selected <? } ?>><?=$s['name']?></option>
                        <? 

                        $last = $s[level];
                      } ?>
                    </select>
                  </div>
                  </div>
                </div>
          </div>
        </div>
      </section>
    </div>

    <div class="row">
      <section class="col-lg-12">

        <div class="card">
          <div class="card-body">
              <div class="row">
                <div class="col-sm-9">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Nome *</label>
                    <input type="text" name="name" class="form-control" placeholder="Agumon" value="<?=$monster[name]?>" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Raridade</label>
                    <select class="form-control" name="rarity">
      <option value="COMMON" <? if ($monster[rarity] == "COMMON") { ?> selected <? } ?>>COMMON</option>
      <option value="UNCOMMON" <? if ($monster[rarity] == "UNCOMMON") { ?> selected <? } ?>>UNCOMMON</option>
      <option value="RARE" <? if ($monster[rarity] == "RARE") { ?> selected <? } ?>>RARE</option>
      <option value="ULTRARARE" <? if ($monster[rarity] == "ULTRARARE") { ?> selected <? } ?>>ULTRARARE</option>
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
                    <textarea class="form-control" name="description" rows="5" maxlength="500" placeholder="Um Digimon dinossáuro com ataques de fogo..."><?=$monster[description]?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="monsterImage" name="image">
                      <label class="custom-file-label" for="monsterImage"><?=$monster[image]?></label>
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
      <option value="BABY" <? if ($monster[level] == "BABY") { ?> selected <? } ?>>BABY</option>
      <option value="INTRAINING" <? if ($monster[level] == "INTRAINING") { ?> selected <? } ?>>IN-TRAINING</option>
      <option value="ROOKIE" <? if ($monster[level] == "ROOKIE") { ?> selected <? } ?>>ROOKIE</option>
      <option value="CHAMPION" <? if ($monster[level] == "CHAMPION") { ?> selected <? } ?>>CHAMPION</option>
      <option value="ARMOR" <? if ($monster[level] == "ARMOR") { ?> selected <? } ?>>ARMOR</option>
      <option value="ULTIMATE" <? if ($monster[level] == "ULTIMATE") { ?> selected <? } ?>>ULTIMATE</option>
      <option value="MEGA" <? if ($monster[level] == "MEGA") { ?> selected <? } ?>>MEGA</option>
      <option value="PERFECT" <? if ($monster[level] == "PERFECT") { ?> selected <? } ?>>PERFECT</option>
                    </select>
                  </div>
                  </div>
                </div>

				<input type="hidden" name="orderr" id="orderr"  value="<?=$monster[orderr]?>">

                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Atributo *</label>
                    <select class="form-control" name="attribute">
      <option value="DATA" <? if ($monster[attribute] == "DATA") { ?> selected <? } ?>>DATA</option>
      <option value="VIRUS" <? if ($monster[attribute] == "VIRUS") { ?> selected <? } ?>>VIRUS</option>
      <option value="VACCINE" <? if ($monster[attribute] == "VACCINE") { ?> selected <? } ?>>VACCINE</option>
                    </select>
                  </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Tipo 1 *</label>
                    <select class="form-control" name="type1">
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
                  </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <div class="form-group">
                    <label>Tipo 2</label>
                    <select class="form-control" name="type2">
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
                    <input type="number" class="form-control" name="hp" id="hp" value="<?=$monster[hp]?>" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>ATK *</label>
                    <input type="number" class="form-control" name="atk" id="atk" value="<?=$monster[atk]?>" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>DEF *</label>
                    <input type="number" class="form-control" name="def" id="def" value="<?=$monster[def]?>" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>SP.ATK *</label>
                    <input type="number" class="form-control" name="spatk" id="spatk" value="<?=$monster[spatk]?>" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>SP.DEF *</label>
                    <input type="number" class="form-control" name="spdef" id="spdef" value="<?=$monster[spdef]?>" onkeyup="calcStats()" required>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- text input -->
                  <div class="form-group">
                    <label>SPD *</label>
                    <input type="number" class="form-control" name="spd" id="spd" value="<?=$monster[spd]?>" onkeyup="calcStats()" required>
                  </div>
                </div>
              </div>

          	</div>

              <div class="card-footer">
	              <button type="submit" class="btn btn-primary">Salvar</button>
                &nbsp;&nbsp;ou&nbsp;&nbsp;
                <button type="button" class="btn btn-danger" onclick="deleteDigimon(<?=$monster[id]?>)">Excluir</button>
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
  function deleteDigimon(monsterId) {
    if(confirm("Será impossível recuperar os dados depois de excluido. Tem certeza de que deseja excluir este Digimon?")){
      location.href="../modules/_delete_specie_submit.php?i="+monsterId;
    }
  }

  function specieChanged() {
    location.href = "../dashboard?o=ee&i="+specie.value;
  }

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
<script type="text/javascript">
  levelAjust();
  calcStats();
</script>