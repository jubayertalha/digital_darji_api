<?php

	require "db.php";

	$ct = $_POST["category"];

	if($ct == "All"){
		$sql = "select * from users_data;";

		$result = mysqli_query($con,$sql);

		$respons = array();

		while($row = $result->fetch_assoc()){
			$respons[] = $row;
		}

		echo json_encode($respons);
	}elseif ($ct == "Popular") {
		$sql = "SELECT * FROM users_data ORDER BY total DESC, star DESC LIMIT 10";

		$result = mysqli_query($con,$sql);

		$respons = array();

		while($row = $result->fetch_assoc()){
			$respons[] = $row;
		}

		echo json_encode($respons);
	}else{
		$sql = "select * from users_data where category like '".$ct."';";

		$result = mysqli_query($con,$sql);

		$respons = array();

		while($row = $result->fetch_assoc()){
			$respons[] = $row;
		}

		echo json_encode($respons);
	}

	mysqli_close($con);

?>