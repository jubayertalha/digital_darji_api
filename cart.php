<?php

	require "db.php";

	$action = $_POST["action"];
	$id = $_POST["id"];
    $type = $_POST["type"];
    $email = $_POST["email"];
    $count = $_POST["count"];
    $price = $_POST["price"];
    $name = $_POST["name"];
    $img = $_POST["img"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    $neckAround = $_POST["neckAround"];
    $shoulderWidth = $_POST["shoulderWidth"];
    $waistAround = $_POST["waistAround"];
    $bicepAround = $_POST["bicepAround"];
    $sleeveLength = $_POST["sleeveLength"];
    $chestAround = $_POST["chestAround"];
    $shirtLength = $_POST["shirtLength"];
    $wristAround = $_POST["wristAround"];

    if($action == "ADD"){

		$sql = "insert into cart_data values(NULL,'".$id."','".$type."','".$email."','".$count."','".$price."','".$name."','".$img."','".$size."','".$color."','".$neckAround."','".$shoulderWidth."','".$waistAround."','".$bicepAround."','".$sleeveLength."','".$chestAround."','".$shirtLength."','".$wristAround."');";

		$result = mysqli_query($con,$sql);

		$code = 1;
		$message = "ADD SUCCESS";
		$respons = array("code"=>$code,"message"=>$message);
		echo json_encode($respons);
	}

	if($action == "GET"){
		$sql = "select * from cart_data where email like '".$email."';";

		$result = mysqli_query($con,$sql);

		$respons = array();

		while($row = $result->fetch_assoc()){
			$respons[] = $row;
		}

		echo json_encode($respons);

	}

	mysqli_close($con);

?>