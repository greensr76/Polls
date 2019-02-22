<?php

$con  = new mysqli('localhost', 'root', '', 'dbpoll');
if (!$con ) {
    die('Could not connect: ' . mysqli_error());
}

if(!isset($_GET['id'])){
	header('Location: pollHome.html');
}

else{
	$id = $_GET['id'];
}


	// Get all the answer choices from the passed poll ID
	$sql = "SELECT qName, ans1, ans2, ans3, ans4, ans5, ans6 FROM answers WHERE IDpoll = '$id'";
	$result = $con->query($sql);
	
	while($row = mysqli_fetch_array($result)) {
	$question = $row['qName'];
	$choice1 = $row['ans1'];
	$choice2 = $row['ans2'];
	$choice3 = $row['ans3'];
	$choice4 = $row['ans4'];
	$choice5 = $row['ans5'];
	$choice6 = $row['ans6'];
	}
	

?>	

<html>
<head>
<link rel = "stylesheet" href = "fancyPoll.css" >
</head>

<body>


<!-- Creates radio button for each option since each poll has to have at least two options after the second one checks if its empty
If choice is empty it will not create an unneccassary radio button
The form also has a hidden value of ID to pass it along to the final poll result page--> 
<div class="poll">
	<h1 style = "fontstyle: bold";> <?php echo $question?></h1>
		<form action = "pollResult.php?id=<?php echo $id; ?>" method = "post">
			
			<input class ="choice" type="radio" name="c"  value = 1 onclick="getVote(this.value)"/> 
			<?php echo $choice1 ?> <br>
			
			<input class ="choice" type="radio" name="c"  value = 2 onclick="getVote(this.value)"/>
			<?php echo $choice2 ?> <br/>
			
			<?php if ($choice3 != null): ?>
				
				<input class ="choice" type="radio" name="c" value = 3 onclick="getVote(this.value)"/> 
				<?php echo $choice3 ?><br>
			<?php endif; ?>	
			
			<?php if ($choice4 != null): ?>
				
				<input class ="choice" type="radio" name="c" value = 4 onclick="getVote(this.value)"/>
				<?php echo $choice4 ?><br/>
			<?php endif; ?>
			
			<?php if ($choice5 != null): ?>
				
				<input class ="choice" type="radio" name="c" value = 5 onclick="getVote(this.value)"/> 
				<?php echo $choice5 ?><br>
			<?php endif; ?>
			
			<?php if ($choice6 != null): ?>
				
				<input class ="choice" type="radio" name="c" value = 6 onclick="getVote(this.value)"/>
				<?php echo $choice6 ?><br/>
			<?php endif; ?>
			
			<input type = "hidden" name = "id" value = "<?php echo $id; ?>"/>
			<input class = "submitButton" type ="submit" value = "Submit" />
		</form>
</div>

<a href = "/poll/pickPoll.php">
<button > Pick Another Poll</button>
</a>



</body>

</html>


<?php
	$con->close();
?>