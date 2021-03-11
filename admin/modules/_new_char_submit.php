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

    $image = date("YmdHis") . "ICN." . $ext;

    $destino = '../../assets/charicons/' . $image;

    $arquivo_tmp = $_FILES['icon']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["icon"] = $image;
}

if ($_FILES['image']['name'] != "") {
    $array = explode('.', $_FILES['image']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "ICN." . $ext;

    $destino = '../../assets/chars/' . $image;

    $arquivo_tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["image"] = $image;
}


$db = new Database();

$r = $db->insert("vms_chars", $dados);

if ($r > 0) {
    log_activity($_SESSION[vms_user], "Cadastrou um novo personagem: $dados[name]");
    exit("<script>location.href='../dashboard?o=np&m=s';</script>");
} else {
    exit("<script>location.href='../dashboard?o=np&m=e';</script>");
}