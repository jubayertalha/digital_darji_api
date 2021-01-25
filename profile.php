<?php

	require "db.php";

	$email = $_POST["email"];
	$type = $_POST["type"];

	$sql = "select * from users_data where email like '".$email."' and type like '".$type."';";

	$sql1 = "select * from product_data where email like '".$email."' and type like 'SELL';";

	$sql2 = "select * from product_data where email like '".$email."' and type like 'PORTFOLIO';";

	$result = mysqli_query($con,$sql);

	$result1 = mysqli_query($con,$sql1);

	$result2 = mysqli_query($con,$sql2);

	while($row = $result->fetch_assoc()){
		$id = $row["_id"];
		$name = $row["name"];
		$occupation = $row["occupation"];
		$address = $row["address"];
		$img = $row["img"];
		$category = $row["category"];
	}

	$sell = mysqli_num_rows($result1);

	$portfolio = mysqli_num_rows($result2);

	$profile = array('id' => $id,'name' => $name, 'occupation' => $occupation, 'address' => $address, 'img' => $img, 'sell' => $sell, 'portfolio' => $portfolio, 'category' => $category );

	echo json_encode($profile);

	mysqli_close($con);

?>