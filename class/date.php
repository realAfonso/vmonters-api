<?

function isDay()
{
    $night1 = strtotime(date('d-m-Y') . '00:00');
    $night2 = strtotime(date('d-m-Y') . '06:00');
    $night3 = strtotime(date('d-m-Y') . '19:00');
    $night4 = strtotime(date('d-m-Y') . '23:59');

    $now = time();

    if (($now >= $night3 && $now <= $night4) || ($now >= $night1 && $now <= $night2)) {
        return false;
    } else {
        return true;
    }
}

function getBeforeHourForTime($hours, $time)
{
    return strtotime('-' . $hours . ' hours', $time);
}

function getAfterHourForTime($hours, $time)
{
    return strtotime('+' . $hours . ' hours', $time);
}

function getBeforeHour($hours)
{
    return strtotime('-' . $hours . ' hours', time());
}

function getAfterHour($hours)
{
    return strtotime('+' . $hours . ' hours', time());
}

function getDateToTime($date){
    return strtotime($date);
}

function getToday()
{
    return date("Y-m-d");
}

function getYesterday()
{
    return date("Y-m-d", strtotime(getToday() . " - 1 days"));
}

function getDay($timestamp)
{
    return date("Y-m-d", $timestamp);
}

function isToday($timestamp)
{
    $lastDate = getDay($timestamp);
    $today = getToday();
    return $lastDate == $today;
}

function isYesterday($timestamp)
{
    $lastDate = getDay($timestamp);
    $yesterday = getYesterday();
    return $lastDate == $yesterday;
}

function isNotToday($timestamp)
{
    return !isToday($timestamp);
}

?>