<?php
	class Parser {
		var $parsed = array();
		var $active_key = "";
		public function validate($post_arr) {
			if(isset($post_arr['job_description']) && !empty($post_arr['job_description'])) {
				return array(
					'status' => true
				);
			} else {
				return array(
					'status' => false,
					'error_msg' => "Job Description is required."
				);
			}
		}
		
		public function doParse($post_arr) {
			$description = $post_arr['job_description'];
			$expl_desc = explode("\n", $description);
			foreach($expl_desc as $line) {
				$this->process($line);
			}
			return $this->parsed;
		}
		
		public function process($line) {
			if(!empty($line)) {
				if(strstr($line, ":")) {
					$expl = explode(":", $line);
					if(!empty($expl[0])) {
						$this->active_key = str_replace(" ", "_", strtolower($expl[0]));
					}
					if(isset($expl[1]) && !empty($expl[1])) {
						$this->parsed[$this->active_key] = trim($expl[1]);
					} else {
						$this->parsed[$this->active_key] = "";
					}
				} else {
					$this->parsed[$this->active_key] .= trim($line);
				}
			}
		}
	}
	
	$obj = new Parser();
	$post_arr = isset($_POST) ? $_POST : array();
	$res = $obj->validate($post_arr);
	if($res['status']) {
		$parsed_str = $obj->doParse($post_arr);
		$res = array(
			'status' => true,
			'data'   => $parsed_str
		);
		echo json_encode($res);
	} else {
		echo json_encode(
			$res
		);
	}
?>