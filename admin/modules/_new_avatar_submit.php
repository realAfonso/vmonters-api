<?php

session_start();

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Recife");

include("../../class/connection.php");
include("../../class/database.php");
include("../../class/log.php");
include("../../class/date.php");

$dados = array();
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if ($_FILES['image']['name'] != "") {
    $array = explode('.', $_FILES['image']['name']);
    $ext = end($array);

    $image = date("YmdHis") . "AVAT." . $ext;

    $destino = '../../assets/avatars/' . $image;

    $arquivo_tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($arquivo_tmp, $destino);

    $dados["image"] = $image;
}

$startDate = "";
$endDate = "";

if (empty($dados[startDate])) {
    $dados[startDate] = 0;
} else {
    $startDate = $dados[startDate];
    $dados[startDate] = getDateToTime($dados[startDate]);
}

if (empty($dados[endDate])) {
    $dados[endDate] = 0;
} else {
    $endDate = $dados[endDate];
    $dados[endDate] = getDateToTime($dados[endDate]);
}

$db = new Database();

$r = $db->insert("vms_avatars", $dados);

if ($r > 0) {
    log_activity($_SESSION[vms_user], "Cadastrou um novo avatar: $dados[description]");
    exit("<script>location.href='../dashboard?o=na&m=s&sd=".$startDate."&ed=".$endDate."&prc=".$dados[price]."';</script>");
} else {
    exit("<script>location.href='../dashboard?o=na&m=e';</script>");
}