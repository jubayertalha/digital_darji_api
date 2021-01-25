<?php
	
	require "db.php";

	$email = $_POST["email"];
	$pass = $_POST["pass"];
	$type = $_POST["type"];

	$sql = "select * from users_data where email like '".$email."' and pass like '".$pass."' and type like '".$type."';";

	$result = mysqli_query($con,$sql);

	if(mysqli_num_rows($result)>0){
		$code = 1;
		$message = "LOGIN SUCCESS";
		$respons = array("code"=>$code,"message"=>$message);
		echo json_encode($respons);
	}else{
		$code = 0;
		$message = "LOGIN FAILED";
		$respons = array("code"=>$code,"message"=>$message);
		echo json_encode($respons);
	}

	mysqli_close($con);

?>