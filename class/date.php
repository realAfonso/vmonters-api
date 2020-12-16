<?

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