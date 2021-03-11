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

$night1 = strtotime(date('d-m-Y') . '00:00');
$night2 = strtotime(date('d-m-Y') . '06:00');
$night3 = strtotime(date('d-m-Y') . '19:00');
$night4 = strtotime(date('d-m-Y') . '23:59');

$now = time();

if (($now >= $night3 && $now <= $night4) || ($now >= $night1 && $now <= $night2)) {
    echo "noite";
} else {
    echo "dia";
}

