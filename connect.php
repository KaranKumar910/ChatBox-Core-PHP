<?php

date_default_timezone_set('ASIA/CALCUTTA');
	function connect($query, $flag = false){

		$con =mysqli_connect('localhost','root','12345678','chatbox') or die('Error=>'.mysql_connect_error());
		$res = $con->query($query);
		return $flag ? $con : $res ;
	
	}
	function post($index = ''){
			if (empty($index)){
				return $_POST;
			}
			if(isset($_POST[$index])){
				return $_POST[$index];
			}
			return '';
	}
	function redirect($page = 'index',$substr = ''){
		$url = $page.'.php';
		$url = $url . (    !empty($substr)  ? '?'.$substr : '' );
		?>
		<script type="text/javascript">
			location.href = '<?=$url?>';
		</script>
		<?php
	}
		function insert($table = '', $data = array(), $flag = false){
		if (empty($table)) {
			die('Please Select a table name');
		}

		$fields = $values = '';
		foreach ($data as $key => $value) {
			$fields .= $key.',';
			$values .= "'".$value."',";
		}
		$fields = trim($fields,',');
		$values = trim($values,',');


		$query = "INSERT INTO $table ( $fields ) VALUES ( $values )";
		 // return($query);
		return connect($query);
	}
?>