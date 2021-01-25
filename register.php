<?php

	require "db.php";

	$_id = $_POST["_id"];
	$action = $_POST["action"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$occupation = $_POST["occupation"];
	$address = $_POST["address"];
	$category = $_POST["category"];
	$type = $_POST["type"];
	$pass = $_POST["pass"];
	$img = $_POST["img"];
	$selectedImg = $_POST["selectedImg"];

	if($action == "REGISTER"){
		$imgPath = "pictures/user_dp/".$img."";

		$sql = "select * from users_data where email like '".$email."';";

		$result = mysqli_query($con,$sql);

		if(mysqli_num_rows($result)>0){
			$code = 0;
			$message = "SIGNUP FAILED - USER EXIST";
			$respons = array("code"=>$code,"message"=>$message);
			echo json_encode($respons);
		}else{
			$sql = "insert into users_data values(NULL,'".$type."','".$email."','".$occupation."','".$address."','".$category."','".$pass."','".$name."','".$imgPath."','0','0','0','0','0','0','0');";

			$result = mysqli_query($con,$sql);

			file_put_contents($imgPath, base64_decode($selectedImg));

			$code = 1;
			$message = "SIGNUP SUCCESS";
			$respons = array("code"=>$code,"message"=>$message);
			echo json_encode($respons);
		}
	}

	if($action == "EDIT"){

		$sql = "select email from users_data where _id = '".$_id."';";

		$result = mysqli_query($con,$sql);

		while($row = $result->fetch_assoc()){
			$oldemail = $row["email"];
		}

		$sql = "update users_data set name = '".$name."', category = '".$category."', occupation = '".$occupation."', email = '".$email."', address = '".$address."' where email like '".$oldemail."';";

		$result = mysqli_query($con,$sql);

		$sql = "update product_data set email = '".$email."' where email like '".$oldemail."';";

		$result = mysqli_query($con,$sql);

		unlink($img);

		file_put_contents($img, base64_decode($selectedImg));

		$code = 1;
		$message = "EDIT SUCCESS";
		$respons = array("code"=>$code,"message"=>$message);
		echo json_encode($respons);
	}

	mysqli_close($con);

?>