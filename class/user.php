<?php
include_once("connection.php");
include_once("database.php");

function getUser($id)
{
    $db = new Database();

    $r = $db->select("vms_active_users", " WHERE id = '" . $id . "'");
    $user = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($user == null) return null;

    $return = array();
    $return["id"] = $user["id"];
    $return["name"] = $user["name"];
    $return["avatar"] = "http://api.vmonsters.com/assets/avatars/" . $user["avatar"];
    $return["wallet"] = $user["wallet"];
    $return["reputation"] = $user["reputation"];
    $return["house"] = $user["house"];
    $return["buddy"] = getBuddy($user["id"]);
    $return["crest"] = getCrest($user["crest"]);

    $return[buddy] = assertHouseyStats($return[buddy], $user["house"]);

    $return["lastRequest"] = $user["lastRequest"];

    $return["badge"] = getUserBadge($user["vip"], $user["type"]);

    return $return;
}

function getUserVip($id)
{
    $db = new Database();

    $user = $db->selectObject("vms_active_users", " WHERE id = '" . $id . "'");

    if ($user == null) return null;

    return $user["vip"];
}

function getUserBadge($userVip, $userType)
{
    $badge = null;

    if ($userType > 1) $badge = "bd_adm.png";
    else if ($userVip == 1) $badge = "bd_baby.png";
    else if ($userVip == 2) $badge = "bd_intraining.png";
    else if ($userVip == 3) $badge = "bd_rookie.png";
    else if ($userVip == 4) $badge = "bd_champion.png";
    else if ($userVip == 5) $badge = "bd_ultimate.png";
    else if ($userVip == 6) $badge = "bd_mega.png";

    if ($badge != null) $badge = "http://api.vmonsters.com/assets/badges/" . $badge;

    return $badge;
}

function getPlaces($userId)
{
    $db = new Database();

    $places = array();

    $r = $db->select("vms_user_has_place", "WHERE user = '$userId'");
    while ($p = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        unset($p[user]);
        array_push($places, $p);
    }

    return $places;
}

function getTowerOfValor($userId)
{
    $db = new Database();

    $towerFloor = $db->selectObject("vms_user_has_valor", "WHERE user = '$userId'");

    if ($towerFloor != null) {
        if ($towerFloor[lastTickets] <= getBeforeHour(2)) {
            $towerFloor[battleTickets] = 10;
            $towerFloor[lastTickets] = time();
            $db->update("vms_user_has_valor", $towerFloor);
        }

        if ($towerFloor[battleTickets] == 0) {
            $towerFloor[countDown] = getAfterHourForTime(2, $towerFloor[lastTickets]) - time();
        } else {
            $towerFloor[countDown] = 0;
        }

        $nextFloor = $towerFloor[floor] + 1;

        $nextPoints = 10;

        for ($i = 2; $i < $nextFloor; $i++) {
            $nextPoints = $nextPoints * 2;
        }

        $towerFloor[nextPoints] = $nextPoints;

        $towerFloor[buddy] = getBuddy($userId);
    }

    return $towerFloor;
}

function getUserName($userId)
{
    $db = new Database();

    $r = $db->select("vms_users", "WHERE id = '$userId'");
    $user = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($user == null) return null;

    $username = $user["name"];

    if ($username == "") $username = "Player12" . $user["id"];

    return $username;
}

function getUserHouse($userId)
{
    $db = new Database();

    $r = $db->select("vms_users", "WHERE id = '$userId'");
    $user = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($user == null) return null;

    return $user["house"];
}

function userHasMoney($userId, $price)
{
    $db = new Database();

    $r = $db->select("vms_users", "WHERE id = '$userId'");
    $user = mysqli_fetch_array($r, MYSQLI_ASSOC);

    if ($user["wallet"] >= $price) {
        return true;
    } else {
        return false;
    }
}

function discountUserWallet($userId, $price)
{
    $db = new Database();

    $r = $db->select("vms_users", "WHERE id = '$userId'");
    $user = mysqli_fetch_array($r, MYSQLI_ASSOC);

    $user["wallet"] = $user["wallet"] - $price;

    $r = $db->update("vms_users", $user);

    return $r;
}

class User
{

    public function getBuddy($id)
    {
        $return = array();

        $db = new Database();

        $r = $db->select("vms_user_has_species", "WHERE user = '$id' AND buddy = '1'");
        $uhs = mysqli_fetch_array($r, MYSQLI_ASSOC);

        if ($uhs == null) return null;

        $return = $this->getMonster($uhs["id"]);

        return $return;
    }

    private function getSpecie($id)
    {
        $db = new Database();
        $r = $db->select("vms_species", "WHERE id = '$id'");
        return mysqli_fetch_array($r, MYSQLI_ASSOC);
    }

    public function getFriends($id)
    {
        $db = new Database();
        $r = $db->select("vms_active_friends", "WHERE userId = '$id'");
        return $r;
    }

    public function getMonster($id)
    {
        $return = array();

        $db = new Database();

        $r = $db->select("vms_active_monsters", "WHERE id = '$id'");
        $uhs = mysqli_fetch_array($r, MYSQLI_ASSOC);

        if ($uhs == null) return null;

        $uhs["image"] = "http://api.vmonsters.com/assets/species/" . $uhs["image"];

        return $uhs;
    }

    public function getCrest($id)
    {
        $db = new Database();

        $r = $db->select("vms_crests", " WHERE id = '$id'");
        $crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

        if ($crest == null) return null;

        $return = array();
        $return["id"] = $crest["id"];
        $return["name"] = $crest["name"];
        $return["icon"] = "http://api.vmonsters.com/assets/crests/" . $crest["icon"];
        $return["colorLight"] = $crest["color_light"];
        $return["colorDark"] = $crest["color_dark"];

        return $return;
    }

    public function getFriend($userId, $friendId)
    {
        $db = new Database();
        $r = $db->select("vms_active_friends", " WHERE userId = '$userId' AND friendId = '$friendId'");
        $user = mysqli_fetch_array($r, MYSQLI_ASSOC);

        $friend = array();
        $friend["id"] = $user["friendId"];
        $friend["nickname"] = $user["nickname"];
        $friend["name"] = $user["name"];
        $friend["avatar"] = "http://api.vmonsters.com/assets/avatars/" . $user["avatar"];
        $friend["buddy"] = $this->getMonster($user["buddy"]);
        $friend["crest"] = $this->getCrest($user["crest"]);

        return $friend;
    }

    public function getUser($id)
    {
        $db = new Database();
        $r = $db->select("vms_active_users", " WHERE id = '" . $id . "'");
        $user = mysqli_fetch_array($r, MYSQLI_ASSOC);

        if ($user == null) return null;

        $return = array();
        $return["id"] = $user["id"];
        $return["name"] = $user["name"];
        $return["avatar"] = "http://api.vmonsters.com/assets/avatars/" . $user["avatar"];
        $return["wallet"] = $user["wallet"];
        $return["reputation"] = $user["reputation"];

        $return["buddy"] = $this->getBuddy($user["id"]);

        $crestId = $user["crest"];

        $r = $db->select("vms_crests", " WHERE id = '$crestId'");
        $crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

        $return["crest"] = array();
        $return["crest"]["name"] = $crest["name"];
        $return["crest"]["icon"] = "http://api.vmonsters.com/assets/crests/" . $crest["icon"];
        $return["crest"]["colorLight"] = $crest["color_light"];
        $return["crest"]["colorDark"] = $crest["color_dark"];

        $return["lastRequest"] = $user["lastRequest"];

        $return["badge"] = $this->getUserBadge($user["vip"], $user["type"]);

        return $return;
    }

    public function getUserBadge($userVip, $userType)
    {
        $badge = null;

        if ($userType > 1) $badge = "bg_adm.png";
        else if ($userVip == 1) $badge = "bg_baby.png";
        else if ($userVip == 2) $badge = "bg_intraining.png";
        else if ($userVip == 3) $badge = "bg_rookie.png";
        else if ($userVip == 4) $badge = "bg_champion.png";
        else if ($userVip == 5) $badge = "bg_ultimate.png";
        else if ($userVip == 6) $badge = "bg_mega.png";

        if ($badge != null) $badge = "http://api.vmonsters.com/assets/badges/" . $badge;

        return $badge;
    }
}

?>