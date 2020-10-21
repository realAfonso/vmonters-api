<?php
	include_once("connection.php");
	include_once("database.php");

	class User {

		public function getBuddy($id) {
			$return = array();

			$db = new Database();

			$r = $db->select("vms_user_has_species", "WHERE user = '$id' AND buddy = '1'");
			$uhs = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($uhs == null) return null;

			$specie = $this->getSpecie($uhs["specie"]);

			$return = array(
				"id" => $uhs["id"],
				"specie" => $specie["name"],
				"name" => $uhs["name"],
				"image" => "http://redigitize.com.br/vmonsters/assets/species/".$specie["image"]
			);

			return $return;
		}

		private function getSpecie($id)
		{
			$db = new Database();
			$r = $db->select("vms_species", "WHERE id = '$id'");
			return mysqli_fetch_array($r, MYSQLI_ASSOC);
		}
	}
?>