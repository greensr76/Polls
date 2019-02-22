<?php

$con  = new mysqli('localhost', 'root', '', 'dbpoll');
if (!$con ) {
    die('Could not connect: ' . mysqli_error());
}
	
	//Getting variables from html form
	$question = $_POST["question"];
	$ans1 = $_POST["ans1"];
	$ans2 = $_POST["ans2"];
	$ans3 = $_POST["ans3"];
	$ans4 = $_POST["ans4"];
	$ans5 = $_POST["ans5"];
	$ans6 = $_POST["ans6"];
	
	//db info
	//$host = "localhost";
	//$db = "hmwk5";
	//$dbUser = "root";
	//$dbPass = "";
		
	//Safety in case they try to create a blank poll
	if ($question == null){
		echo "Error:  Must put in a Question Name";
		header('Location: pollCreate.html');
	}
	
	
	
	else{
		//Query
		// When Creating a poll choices cannot contain contractions or any use of this ' character
		$sql = "INSERT INTO answers (qName, ans1, ans2, ans3, ans4, ans5, ans6) 
		VALUES ('$question', '$ans1', '$ans2', '$ans3','$ans4', '$ans5', '$ans6')";

		if ($con->query($sql) === TRUE) {
			
			
			//This part was a little tricky
			// In order to create the other entry for the second table that counts votes they needed to share the same poll IDpoll
			// The best way to manage this is upon creation it'll create a row in the vote table using the IDpoll that was just made for the newly created poll
			$seql = "SELECT IDpoll 
			FROM answers
			WHERE qName = '$question'";
							
			$result = $con->query($seql);
		
			while($row = mysqli_fetch_array($result)) {
				$pollID = $row['IDpoll'];
				
			}
			
			echo $pollID;
			
			//Query
			$sequel = "INSERT INTO votes (IDpoll) 
			VALUES ('$pollID')";
			if ($con->query($sequel) === TRUE){
				
			//If query goes through the user will be redirected to the home page where they can proceed to vote on their poll/any poll or create another poll
			// 
				header('Location: pollHome.html');
				echo "New Poll created successfully";
			}
			
			else{
				echo "This ain't it";
			}
		} 
		else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
	}
	$con->close();
?>