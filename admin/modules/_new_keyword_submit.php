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

$isFirst = true;
$keyy = "";

foreach ($dados[keyys] as $key => $value){
    if($isFirst){
        $keyy = $value[keyword];
        $isFirst = false;
    }else{
        $value[keyword] = $keyy;
    }

    $r = $db->insert("vms_keywords", $value);
}

if ($r > 0) {
    log_activity($_SESSION[vms_user], "Cadastrou uma nova palavra-chave: $keyy");
    exit("<script>location.href='../dashboard?o=npc&m=s';</script>");
} else {
    exit("<script>location.href='../dashboard?o=npc&m=e';</script>");
}