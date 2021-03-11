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

$r = $db->insert("vms_place_has_story", $dados);

if ($r > 0) {
    log_activity($_SESSION[vms_user], "Cadastrou uma nova história");
    exit("<script>location.href='../dashboard?o=eh&m=s';</script>");
} else {
    exit("<script>location.href='../dashboard?o=eh&m=e';</script>");
}