<?php
	class Database {
		var $mysqli;

		public function insert($table, $array, $showQuery=false) {
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
			if($showQuery) echo $sql;
			$result = $mysqli->query($sql);
			$lastId = $mysqli->insert_id;
			$mysqli = $conn->close($mysqli);

			if($result == false){
				return -1;
			}else{
				return $lastId;
			}
		}

		public function update($table, $array, $showQuery=false) {
			$conn = new Connection();
			$mysqli = $conn->open();
			$id = $array["id"];
			unset($array["id"]);
			$sql = "UPDATE $table SET ";
			foreach ($array as $key => $value) {
				if ($value != null) {
					$sql .= $mysqli->real_escape_string($key)." = '".$mysqli->real_escape_string($value)."', ";
				} else {
					$sql .= $mysqli->real_escape_string($key)." = NULL, ";
				}
			}
			if($target == "") {
				$sql .= "WHERE id = '".$id."'";
			} else {
				$sql .= "WHERE ".$target." = '".$array[$target]."'";
			}
			$sql = str_replace("', WHERE", "' WHERE", $sql);
			$sql = str_replace(", WHERE", " WHERE", $sql);
			if($showQuery) echo $sql;
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}

		public function select($table, $cond="", $showQuery=false) {
			$conn = new Connection();
			$mysqli = $conn->open();
			$sql = "SELECT * FROM $table ".$cond;
			if($showQuery) echo $sql;
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}

		public function selectObject($table, $cond="", $showQuery=false) {
			$r = $this->select($table, $cond, $showQuery);
			$o = mysqli_fetch_array($r, MYSQLI_ASSOC);
			return $o;
		}

		public function selectArray($table, $cond="", $showQuery=false) {
			$return = array();
			$r = $this->select($table, $cond, $showQuery);
			while($o = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				array_push($return, $o);
			}
			return $return;
		}

		public function delete($table, $id, $showQuery=false) {
			$conn = new Connection();
			$mysqli = $conn->open();
			$sql = "DELETE FROM $table WHERE id = '".$mysqli->real_escape_string($id)."'";
			if($showQuery) echo $sql;
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}

		public function sql($sql, $showQuery=false) {
			if($showQuery) echo $sql;
			$conn = new Connection();
			$mysqli = $conn->open();
			$result = $mysqli->query($sql);
			$mysqli = $conn->close($mysqli);
			return $result;
		}

		public function count($table, $cond="", $showQuery=false) {
			$r = $this->sql("SELECT count(*) as quantity FROM $table $cond", $showQuery);
  			$count = mysqli_fetch_array($r, MYSQLI_ASSOC);
			return $count[quantity];
		}
	}
?>