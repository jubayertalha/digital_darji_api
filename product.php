<?php

	require "db.php";

	$_id = $_POST["_id"];
	$action = $_POST["action"];
	$email = $_POST["email"];
	$type = $_POST["type"];
	$name = $_POST["name"];
	$category = $_POST["category"];
	$price = $_POST["price"];
	$img = $_POST["img"];
	$selectedImg = $_POST["selectedImg"];

	if($action == "GET"){
		$sql = "select * from product_data where email like '".$email."' and type like '".$type."';";

		$result = mysqli_query($con,$sql);

		$respons = array();

		while($row = $result->fetch_assoc()){
			$respons[] = $row;
		}

		echo json_encode($respons);

	}

	if($action == "ADD"){
		$imgPath = "pictures/product/".$img."";

		$sql = "insert into product_data values(NULL,'".$email."','".$type."','".$name."','".$category."','".$price."','".$imgPath."','0','0','0','0','0','0','0');";

		$result = mysqli_query($con,$sql);

		file_put_contents($imgPath, base64_decode($selectedImg));

		$code = 1;
		$message = "ADD SUCCESS";
		$respons = array("code"=>$code,"message"=>$message);
		echo json_encode($respons);
	}

	if($action == "REMOVE"){
		$sql = "select img from product_data where _id = '".$_id."';";

		$result = mysqli_query($con,$sql);

		while($row = $result->fetch_assoc()){
			$img = $row["img"];
		}

		unlink($img);

		$sql = "delete from product_data where _id = '".$_id."';";

		$result = mysqli_query($con,$sql);

		$code = 1;
		$message = "REMOVE SUCCESS";
		$respons = array("code"=>$code,"message"=>$message);
		echo json_encode($respons);
	}

	if ($action == "EDIT") {
		$sql = "update product_data set name = '".$name."', category = '".$category."', price = '".$price."' where _id = '".$_id."';";

		$result = mysqli_query($con,$sql);

		$sql = "select img from product_data where _id = '".$_id."';";

		$result = mysqli_query($con,$sql);

		while($row = $result->fetch_assoc()){
			$img = $row["img"];
		}

		unlink($img);

		file_put_contents($img, base64_decode($selectedImg));

		$code = 1;
		$message = "EDIT SUCCESS";
		$respons = array("code"=>$code,"message"=>$message);
		echo json_encode($respons);
	}

	mysqli_close($con);

?>