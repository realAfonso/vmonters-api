<?

	function getMessages($senderId, $receiverId, $reference)
	{
		$db = new Database();

		$r = $db->select("vms_messages", "WHERE (receiver = '$senderId' OR receiver = '$receiverId') AND reference = '$reference' ORDER BY hour ASC");

		$messages = array();

		while($i = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			$m = array();
			$m[user] = getUser($i[sender], false);
			if($m[user] != null) {
                $m[message] = filterMessageCharacteres($i[message]);
                $m[hour] = $i[hour];

                array_push($messages, $m);
            }
		}

		return $messages;
	}

	function filterMessageCharacteres($message)
	{
		$message = str_replace("&#34;", "\"", $message);

		return $message;
	}

?>