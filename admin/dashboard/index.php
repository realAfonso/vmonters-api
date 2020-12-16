<?

	session_start();
	date_default_timezone_set("America/Recife");

	include_once("../../class/connection.php");
	include_once("../../class/database.php");
	include_once("../../class/framework.php");

	if($_SESSION["vms_user"] == null || $_SESSION["vms_user"] == ""){
		?><script>location.href="../login";</script>><?
	}

	$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

	$option = $data["o"];

?>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>V-Monsters | Admin</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../dashboard" class="brand-link">
      <img src="<?=$_SESSION[vms_avatar]?>" alt="User image" class="brand-image img-circle">
      <span class="brand-text font-weight-light"><?=$_SESSION[vms_name]?></span>
    </a>

    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Minha conta
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!--<li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Trocar senha</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="_logout.php" class="nav-link">
                  <p>Sair</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-header">MONSTERS</li>

          <li class="nav-item <? if($option == 'ne' || $option == 'ee') { ?>menu-open<? } ?>">
            <a href="#" class="nav-link <? if($option == 'ne' || $option == 'ee') { ?>active<? } ?>">
              <i class="nav-icon fas fa-paw"></i>
              <p>
                Espécies
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../dashboard?o=ne" class="nav-link">
                  <p>Nova espécie</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../dashboard?o=ee" class="nav-link">
                  <p>Editar espécie</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <? if($option == 'nv' || $option == 'ev') { ?>menu-open<? } ?>">
            <a href="#" class="nav-link <? if($option == 'nv' || $option == 'ev') { ?>active<? } ?>">
              <i class="nav-icon fas fa-upload"></i>
              <p>
                Evoluções
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../dashboard?o=nv" class="nav-link">
                  <p>Nova evolução</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../dashboard?o=ev" class="nav-link">
                  <p>Editar evolução</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">HISTÓRIA</li>

          <li class="nav-item <? if($option == 'np' || $option == 'ep') { ?>menu-open<? } ?>">
            <a href="#" class="nav-link <? if($option == 'np' || $option == 'ep') { ?>active<? } ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Personagens
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../dashboard?o=np" class="nav-link">
                  <p>Novo personagem</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../dashboard?o=ep" class="nav-link">
                  <p>Editar personagem</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <? if($option == 'nm' || $option == 'em') { ?>menu-open<? } ?>">
            <a href="#" class="nav-link <? if($option == 'nm' || $option == 'em') { ?>active<? } ?>">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>
                Mapas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../dashboard?o=nm" class="nav-link">
                  <p>Novo mapa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../dashboard?o=em" class="nav-link">
                  <p>Editar mapa</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <? if($option == 'nl' || $option == 'el') { ?>menu-open<? } ?>">
            <a href="#" class="nav-link <? if($option == 'nl' || $option == 'el') { ?>active<? } ?>">
              <i class="nav-icon fas fa-map-marker-alt"></i>
              <p>
                Locais
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../dashboard?o=nl" class="nav-link">
                  <p>Novo local</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../dashboard?o=el" class="nav-link">
                  <p>Editar local</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><?
    

  	if($option == "ne"){
      require_once("../modules/_new_specie_view.php");
  	}else if($option == "ee"){
      require_once("../modules/_edit_specie_view.php");
    }else if($option == "nv"){
      require_once("../modules/_new_evolution_view.php");
    }else if($option == "ev"){
      require_once("../modules/_edit_evolution_view.php");
    }else if($option == "nm"){
      require_once("../modules/_new_map_view.php");
    }else{
  		require_once("_dashboard.php");
  	}


  ?></div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="https://vmonsters.com/">V-Monsters</a></strong>
    Todos os reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 0.6.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
</body>
</html>
