<?

ini_set("memory_limit", "500M");
header('Content-type: application/json');

include("../../../class/pretty_json.php");
include("../../../class/connection.php");
include("../../../class/database.php");
include("../../../class/log.php");

$data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

$db = new Database();

$return = array();

$r = $db->select("vms_eggs", "WHERE id = '" . $data["e"] . "'");
$e = mysqli_fetch_array($r, MYSQLI_ASSOC);

log_activity($data[i], "Usuário tentando comprar um ovo");

if ($e == null) {
    $return["success"] = false;
    $return["code"] = 1;
    $return["message"] = "Não tem ovo";
    log_activity($data[i], "Não existe ovo à venda com o id $data[e]");
} else {

    $r = $db->select("vms_users", "WHERE id = '" . $data["i"] . "'");
    $u = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($u == null) {
        $return["success"] = false;
        $return["message"] = "Usuário falso";
    } else {

        if ($u["wallet"] >= $e["price"]) {

            $uhe = array();
            $uhe["user"] = $data["i"];
            $uhe["egg"] = $data["e"];

            $r = $db->insert("vms_user_has_eggs", $uhe);

            if ($r > 0) {
                $wallet = $u["wallet"] - $e["price"];
                $o = $db->sql("UPDATE vms_users SET wallet = '$wallet' WHERE id = '" . $data["i"] . "'");

                if ($r == true) {
                    $return["success"] = true;
                    $return["message"] = "sucesso";
                    $return["response"] = $wallet;
                    log_activity($data[i], "Usuário comprou um ovo com sucesso");
                }
            } else {
                $return["success"] = false;
                $return["message"] = "Ocorreu um erro inesperado, tente novamente mais tarde.";
                log_activity($data[i], "Não foi possível efetuar a compra do ovo");
            }
        } else {

            $return["success"] = false;
            $return["message"] = "Não tem dinheiro";
            log_activity($data[i], "Usuário não tem dinheiro suficiente pra comprar o ovo");
        }

    }

}


print_r(pretty_json(json_encode($return)));

?>