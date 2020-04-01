<?php
	require("config.php");
	class Save {
		var $conn = '';
		
		function __construct() {
			$this->conn = mysqli_connect(HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		}
		
		public function add ($post_arr) {
			$insert_qry = "INSERT INTO job_description SET ";
			$attributes = "";
			foreach($post_arr as $key => $val) {
				if(empty($attributes)) {
					$attributes = $key .'="'.mysqli_real_escape_string($this->conn, $val).'"';
				} else {
					$attributes .= ', '.$key .'="'.mysqli_real_escape_string($this->conn, $val).'"';
				}
			}
			$insert_qry .= $attributes;
			
			if(mysqli_query($this->conn, $insert_qry)) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	$obj = new Save();
	$post_arr = $_POST;
	$response = $obj->add($post_arr);
	$result = array(
		'status' => $response,
		'msg'		=> "Job description saved successfully."
	);
	if(!$response) {
		$result['msg'] = "Something went wrong. Please try again.";
	}
	echo json_encode($result);
?>