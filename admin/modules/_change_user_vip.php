<?
session_start();

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Recife");

include("../../class/connection.php");
include("../../class/database.php");
include("../../class/log.php");
include("../../class/user.php");
include("../../class/push.php");

$dados = array();
$dados = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

$db = new Database();

$user = array();
$user[id] = $dados[u];
$user[vip] = $dados[v];

$r = $db->update("vms_users", $user);

$userName = getUserName($user[id]);

if($r == true) {
    log_activity($_SESSION[vms_user], "Atualizou o VIP de um usuário: $userName");

    if($user[vip] > 0) {
        $filter = array(
            "field" => "tag",
            "key" => "user",
            "relation" => "=",
            "value" => $user[id]
        );

        $pushData = array(
            "title" => "Agora você é VIP!",
            "message" => "Parabéns " . $userName . "! Obrigado por apoiar o projeto, e agora você já pode usufruir de todos os benefícios do seu plano VIP!",
            "filter" => $filter,
            "android" => true
        );

        preparePush($pushData);
    }else{
        $filter = array(
            "field" => "tag",
            "key" => "user",
            "relation" => "=",
            "value" => $user[id]
        );

        $pushData = array(
            "title" => "Seu plano VIP expirou...",
            "message" => $userName . ", agradecemos por apoiar o projeto até aqui, e esperamos contar com seu apoio futuramente mais uma vez!",
            "filter" => $filter,
            "android" => true
        );

        preparePush($pushData);
    }

    exit("<script>location.href='../dashboard?o=lu&d=s';</script>");
}else{
    exit("<script>location.href='../dashboard?o=lu&d=e';</script>");
}

?>