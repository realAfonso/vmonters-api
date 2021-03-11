<?php

session_start();

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Recife");

include("../../class/connection.php");
include("../../class/database.php");
include("../../class/log.php");

$dados = array();
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if ($_FILES['imageIcon']['name'] != "") {
    $array = explode('.', $_FILES['imageIcon']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "ICN." . $ext;

    $destino = '../../assets/mapgrounds/' . $image;

    $arquivo_tmp = $_FILES['imageIcon']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["imageIcon"] = $image;
}

if ($_FILES['imageInteral']['name'] != "") {
    $array = explode('.', $_FILES['imageInteral']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "INT." . $ext;

    $destino = '../../assets/mapgrounds/' . $image;

    $arquivo_tmp = $_FILES['imageInteral']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["imageInteral"] = $image;
}

if ($_FILES['storyInternal']['name'] != "") {
    $array = explode('.', $_FILES['storyInternal']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "INT." . $ext;

    $destino = '../../assets/backgrounds/' . $image;

    $arquivo_tmp = $_FILES['storyInternal']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["storyInternal"] = $image;
}

if ($_FILES['imageDay']['name'] != "") {
    $array = explode('.', $_FILES['imageDay']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "DAY." . $ext;

    $destino = '../../assets/mapgrounds/' . $image;

    $arquivo_tmp = $_FILES['imageDay']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["imageDay"] = $image;
}

if ($_FILES['storyDay']['name'] != "") {
    $array = explode('.', $_FILES['storyDay']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "DAY." . $ext;

    $destino = '../../assets/backgrounds/' . $image;

    $arquivo_tmp = $_FILES['storyDay']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["storyDay"] = $image;
}

if ($_FILES['imageNight']['name'] != "") {
    $array = explode('.', $_FILES['imageNight']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "NIGHT." . $ext;

    $destino = '../../assets/mapgrounds/' . $image;

    $arquivo_tmp = $_FILES['imageNight']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["imageNight"] = $image;
}

if ($_FILES['storyNight']['name'] != "") {
    $array = explode('.', $_FILES['storyNight']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "NIGHT." . $ext;

    $destino = '../../assets/backgrounds/' . $image;

    $arquivo_tmp = $_FILES['storyNight']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["storyNight"] = $image;
}

$db = new Database();

$r = $db->insert("vms_maps", $dados);

if ($r == true) {
    log_activity($_SESSION[vms_user], "Cadastrou um novo Mapa: $dados[name]");
    exit("<script>location.href='../dashboard?o=nm&m=s';</script>");
} else {
    exit("<script>location.href='../dashboard?o=nm&m=e';</script>");
}