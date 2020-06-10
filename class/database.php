<?php
	class Database {
		var $mysqli;

		public function insert($table, $array) {
			$conn = new Connection();
			$mysqli = $conn->open();
			$sql = "INSERT INTO $table (";
			foreach ($array as $key => $value) {
				$sql .= $mysqli->real_escape_string($key).", ";
			}
			$sql .= ") VALUES (";
			foreach ($array as $key => $value) {
				$sql .= "'".$mysqli->real_escape_string($value)."', ";
			}
			$sql .= ")";
			$sql = str_replace(", )", ")", $sql);
			$result = $mysqli->query($sql);
			$lastId = $mysqli->insert_id;
			$mysqli = $conn->close($mysqli);

			if($result == false){
				return -1;
			}else{
				return $lastId;
			}
		}

		public function update($table, $array, $target = "") {
			$conn = new Connection();
			$mysqli = $conn->open();
			$id = $array["id"];
			unset($array["id"]);
			$sql = "UPDATE $table SET ";
			foreach ($array as $key => $value) {
				$sql .= $mysqli->real_escape_string($key)." = '".$mysqli->real_escape_string($value)."', ";
			}
			if($target == "") {
				$sql .= "WHERE id = '".$id."'";
			} else {
				$sql .= "WHERE ".$target." = '".$array[$target]."'";
			}
			$sql = str_replace("', WHERE", "' WHERE", $sql);
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}

		public function select($table, $cond="") {
			$conn = new Connection();
			$mysqli = $conn->open();
			$sql = "SELECT * FROM $table ".$cond;
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}

		public function delete($table, $id) {
			$conn = new Connection();
			$mysqli = $conn->open();
			$sql = "DELETE FROM $table WHERE id = '".$mysqli->real_escape_string($id)."'";
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}

		public function sql($sql) {
			$conn = new Connection();
			$mysqli = $conn->open();
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}
	}
?>