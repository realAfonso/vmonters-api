<?

date_default_timezone_set("America/Recife");

include("class/pretty_json.php");
include("class/connection.php");
include("class/database.php");
include("class/user.php");
include("class/date.php");
include("class/specie.php");
include("class/crest.php");

$db = new Database();

$towerFloor = $db->selectObject("vms_user_has_valor", "WHERE user = '18'");

$hora = time();
$afterHour = getAfterHourForTime(2, $hora);

echo "$afterHour<br>$hora";

