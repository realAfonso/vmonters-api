<?

  $db = new Database();

  $users = $db->count("vms_users", "WHERE status = '1'");
  $usersTotal = $db->count("vms_users");
  $species = $db->count("vms_species");
  $eggs = $db->count("vms_user_has_species");

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
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
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?=$users?><sup style="font-size: 20px"> de <?=$usersTotal?></sup></h3>

            <p>Usuários ativos</p>
          </div>
          <div class="icon">
            <i class="nav-icon fas fa-users"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?=$species?></h3>

            <p>Espécies cadastradas</p>
          </div>
          <div class="icon">
            <i class="nav-icon fas fa-paw"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?=$eggs?></h3>

            <p>Ovos rachados</p>
          </div>
          <div class="icon">
            <i class="nav-icon fas fa-egg"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>0</h3>

            <p>Bugs reportados</p>
          </div>
          <div class="icon">
            <i class="nav-icon fas fa-bug"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <section class="col-lg-12 connectedSortable">
        
        <form action="../dashboard">
          <div class="col-md-12">
              <div class="form-group">
                  <div class="input-group input-group-lg">
                      <input type="search" class="form-control form-control-lg" name="s" placeholder="Pesquisar por usuário ou ação">
                      <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                              <i class="fa fa-search"></i>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
        </form>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Registro de atividades</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Usuário</th>
                  <th>Ação</th>
                  <th>Horário</th>
                </tr>
              </thead>
              <tbody>

                <? 

                  if($data[s] != ""){
                      $terms = explode(" && ", $data[s]);
                      if(sizeof($terms) > 1){
                          $r = $db->select("vms_active_logs", "WHERE name LIKE '%$terms[0]%' AND action LIKE '%$terms[1]%' LIMIT 200");
                      }else{
                          $r = $db->select("vms_active_logs", "WHERE name LIKE '%$data[s]%' OR action LIKE '%$data[s]%' LIMIT 200");
                      }
                  }else{
                    $r = $db->select("vms_active_logs", "LIMIT 100");
                  }
                  
                  while($l = mysqli_fetch_array($r, MYSQLI_ASSOC)){ ?>
                      
                      <tr>
                        <td>
                          <img src="http://api.vmonsters.com/assets/avatars/<?=$l[image]?>" class="brand-image img-circle" height="30px">&nbsp;&nbsp;<?=$l[name]?>
                        </td>
                        <td><?

                         if(strpos($l[action], ".jpg") === false){
                            echo $l[action];
                         }else{
                            $values = explode(": ", $l[action]);
                            echo $values[0].": ";
                            ?><img src="http://api.vmonsters.com/assets/avatars/<?=$values[1]?>" class="brand-image img-circle" height="30px"><?
                         }

                        ?></td>
                        <td><?=date("H:i - d/m", $l[hour])?></td>
                      </tr>

                <? } ?>
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </section>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>