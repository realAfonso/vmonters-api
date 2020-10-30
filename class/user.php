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
				"image" => "http://api.vmonsters.com/assets/species/".$specie["image"]
			);

			return $return;
		}

		private function getSpecie($id){
			$db = new Database();
			$r = $db->select("vms_species", "WHERE id = '$id'");
			return mysqli_fetch_array($r, MYSQLI_ASSOC);
		}

		public function getFriends($id) {
			$db = new Database();
			$r = $db->select("vms_active_friends", "WHERE userId = '$id'");
			return $r;
		}

		public function getMonster($id) {
			$return = array();

			$db = new Database();

			$r = $db->select("vms_user_has_species", "WHERE id = '$id'");
			$uhs = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($uhs == null) return null;

			$specie = $this->getSpecie($uhs["specie"]);

			$return = array(
				"id" => $uhs["id"],
				"specie" => $specie["name"],
				"name" => $uhs["name"],
				"image" => "http://api.vmonsters.com/assets/species/".$specie["image"]
			);

			return $return;
		}

		public function getCrest($id) {
			$db = new Database();

			$r = $db->select("vms_crests", " WHERE id = '$id'");
			$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($crest == null) return null;

			$return = array();
			$return["name"] = $crest["name"];
			$return["icon"] = "http://api.vmonsters.com/assets/crests/".$crest["icon"];
			$return["colorLight"] = $crest["color_light"];
			$return["colorDark"] = $crest["color_dark"];

			return $return;
		}

		public function getFriend($userId, $friendId) {
			$db = new Database();
			$r = $db->select("vms_active_friends", " WHERE userId = '$userId' AND friendId = '$friendId'");
			$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

			$friend = array();
			$friend["id"] = $user["friendId"];
			$friend["nickname"] = $user["nickname"];
			$friend["name"] = $user["name"];
			$friend["avatar"] = "http://api.vmonsters.com/assets/avatars/".$user["avatar"];
			$friend["buddy"] = $this->getMonster($user["buddy"]);
			$friend["crest"] = $this->getCrest($user["crest"]);

			return $friend;
		}

		public function getUser($id){
			$db = new Database();
			$r = $db->select("vms_active_users", " WHERE id = '".$id."'");
			$user = mysqli_fetch_array($r, MYSQLI_ASSOC);

			if($user == null) return null;

			$return = array();
			$return["id"] = $user["id"];
			$return["name"] = $user["name"];
			$return["avatar"] = "http://api.vmonsters.com/assets/avatars/".$user["avatar"];
			$return["wallet"] = $user["wallet"];
			$return["reputation"] = $user["reputation"];

			$return["buddy"] = $this->getBuddy($user["id"]);

			$crestId = $user["crest"];

			$r = $db->select("vms_crests", " WHERE id = '$crestId'");
			$crest = mysqli_fetch_array($r, MYSQLI_ASSOC);

			$return["crest"] = array();
			$return["crest"]["name"] = $crest["name"];
			$return["crest"]["icon"] = "http://api.vmonsters.com/assets/crests/".$crest["icon"];
			$return["crest"]["colorLight"] = $crest["color_light"];
			$return["crest"]["colorDark"] = $crest["color_dark"];

			$return["lastRequest"] = $user["lastRequest"];

			return $return;
		}
	}
?>