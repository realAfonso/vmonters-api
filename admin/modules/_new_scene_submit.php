<?php

session_start();

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Recife");

include("../../class/connection.php");
include("../../class/database.php");
include("../../class/log.php");

$dados = array();
$dados = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$db = new Database();

if($dados[position] > 1) {
    $last = $db->selectObject("vms_scenes", "WHERE keyy = '$dados[keyy]' ORDER BY position DESC LIMIT 1");
    $lastPosition  = $last[position] + 1;
    $dados[position] = $lastPosition;
}

if(empty($dados[extraAction])) unset($dados[extraAction]);

if(empty($dados[unlockKeyword])) unset($dados[unlockKeyword]);

if(empty($dados[removeKeyword])) unset($dados[removeKeyword]);

$r = $db->insert("vms_scenes", $dados);

if ($r > 0) {
    log_activity($_SESSION[vms_user], "Cadastrou uma nova cena: $dados[keyy] ($dados[position])");
    exit("<script>location.href='../dashboard?o=ns&m=s&k=$dados[keyy]&ci=$dados[charId]';</script>");
} else {
    exit("<script>location.href='../dashboard?o=ns&m=e&k=$dados[keyy]&ci=$dados[charId]';</script>");
}