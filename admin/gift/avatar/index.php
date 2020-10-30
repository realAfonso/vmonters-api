
<style type="text/css">
	#container {
		margin: 0 auto;
		margin-top: 3%;
		margin-bottom: 7%;
		width: 30%;
	}
	.full {
		width: 100%;
	}
</style>

<?

	include("../../../class/pretty_json.php");
	include("../../../class/connection.php");
	include("../../../class/database.php");
	include("../../../class/user.php");

	?><div id="container"><?

	$db = new Database();

	$r = $db->select("vms_avatars", "WHERE isDefault = 0");

	?>
		<form action="submit.php" method="POST">
		<label>Avatar:</label>
		<select class="full" name="avatar">
	<?

	while($a = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		echo "<option value='".$a["id"]."'>".$a["description"]."</option>";
	}

	?>
		</select>

		<br>
		<br>

		<label>Users:</label><br>
	<?

	$r = $db->select("vms_users", "ORDER BY id DESC");
	while($u = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		$name = $u["name"];
		if($name == "") $name = "Jogador12".$u["id"];

		$active = "disabled";
		if($u["status"] == "1") $active = "";

		echo "<input type='checkbox' name='users[]' value='".$u["id"]."' $active> (PL-12".$u["id"].") ".$name."</input><br>";
	}

	?>
	<br><br>
	<input class="full" type="submit" value="Send GIFT to Tamers"/>

	</form></div><?

?>