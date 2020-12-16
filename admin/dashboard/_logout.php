<?

	session_start();

	$_SESSION["vms_user"] = null;
	$_SESSION["vms_name"] = null;
	$_SESSION["vms_type"] = null;
	$_SESSION["vms_avatar"] = null;

	exit("<script>location.href='../login';</script>");

?>