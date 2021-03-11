<?php

session_start();

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Recife");

include("../../class/connection.php");
include("../../class/database.php");
include("../../class/log.php");

$dados = array();
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if ($_FILES['icon']['name'] != "") {
    $array = explode('.', $_FILES['icon']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "ICNP." . $ext;

    $destino = '../../assets/mapgrounds/' . $image;

    $arquivo_tmp = $_FILES['icon']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["icon"] = $image;
} else if ($dados["icons"] != "default") {
    $dados["icon"] = $dados["icons"];
}

if($dados[type] == "MAP"){
    $dados[actionId] = $dados[actionIdMap];
}else{
    $dados[actionId] = $dados[actionIdChar];
}

unset($dados["icons"]);
unset($dados[actionIdMap]);
unset($dados[actionIdChar]);

$db = new Database();

$r = $db->insert("vms_map_has_place", $dados);

if ($r > 0) {
    log_activity($_SESSION[vms_user], "Cadastrou um novo Local");
    exit("<script>location.href='../dashboard?o=el&m=s';</script>");
} else {
    exit("<script>location.href='../dashboard?o=el&m=e';</script>");
}