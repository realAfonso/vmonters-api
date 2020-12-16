<?

	function log_activity($userId, $action) {
		$log = array(
			"user" => $userId,
			"action" => $action,
			"hour" => time()
		);

		$db = new Database();
		$r = $db->insert("vms_logs", $log);
	}

?>