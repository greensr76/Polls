<?php

$con  = new mysqli('localhost', 'root', '', 'dbpoll');
if (!$con ) {
    die('Could not connect: ' . mysqli_error());
}

if(!isset($_GET['id'])){
	header('Location: pickPoll.php');
}

else{
	$id = $_GET['id'];
}
	$sql = "SELECT qName, ans1, ans2, ans3, ans4, ans5, ans6 
	FROM answers
	WHERE IDpoll = '$id'";
	$result = $con->query($sql);
	
	
	// Start the same as the vote page as it'll need the Question Name to put into the header and also a list of all choices for labeling the graph
	while($row = mysqli_fetch_array($result)) {
	$question = $row['qName'];
	$choice1 = $row['ans1'];
	$choice2 = $row['ans2'];
	$choice3 = $row['ans3'];
	$choice4 = $row['ans4'];
	$choice5 = $row['ans5'];
	$choice6 = $row['ans6'];
	}
	
	//Calculates which radio button was selected and proceeds to update the voting table by incrementing that option by 1
	//Glitch as of now it'll increment the option by 2 for every one vote
	$select = 'vote1';
	if (isset($_POST['c'])){
		$select = "vote".$_POST['c'];
		
	}

	$seql = "UPDATE votes SET $select = $select + 1 WHERE IDpoll = '$id'";
	$result = mysqli_query($con,$seql);
	
	if( $con->query($seql) == TRUE){
		#echo "Vote Update Successful";
	}
	else {
		echo "Error: " . $seql . "<br>" . $con->error;
	}
	
	
	//Next it does query to get all the voting numbers for each option
	$sql2 = "SELECT vote1, vote2, vote3, vote4, vote5, vote6 
	FROM votes
	WHERE IDpoll = '$id'";
	$result = $con->query($sql2);
	
	while($row = mysqli_fetch_array($result)) {
	$voted1 = $row['vote1'];
	$voted2 = $row['vote2'];
	$voted3 = $row['vote3'];
	$voted4= $row['vote4'];
	$voted5 = $row['vote5'];
	$voted6 = $row['vote6'];
	
	}
	
	//Need the total to calculate percentages of each choice
	$totalVotes = $voted1 + $voted2 + $voted3 + $voted4 + $voted5 + $voted6;

	
	$percent1 = round($voted1/$totalVotes *100);
	$percent2 = round($voted2/$totalVotes *100);
	$percent3 = round($voted3/$totalVotes *100);
	$percent4 = round($voted4/$totalVotes *100);
	$percent5 = round($voted5/$totalVotes *100);
	$percent6 = round($voted6/$totalVotes *100);
	
	//To make the bar graph vertical I needed to create each bar by using the percent that was left from 100 instead of the actual percent
	//This is because window screens have a y-axis that increases as it goes down so when I first implemented the bars they were all upside down
	$percent1Left = 100 - $percent1;
	$percent2Left = 100 - $percent2;
	$percent3Left = 100 - $percent3;
	$percent4Left = 100 - $percent4;
	$percent5Left = 100 - $percent5;
	$percent6Left = 100 - $percent6;

?>	

<html>
<head>
<link rel = "stylesheet" href = "fancyPoll.css" >

</head>

<body>

<h1> <?php echo "$question"; ?> </h1>

	<!-- Put the whole graph into a single containerBar
	Each one is made pretty much the same
	Start with one outside div object under class bar
		All bars have a fixed height and are essentially the background of the bar
	The bars are neccessary because from there I can create an inner div object that can have its height set to a percentage of the initial bar
		By adding color to separate them I then have a bar that is shaded to the percentage of each option making it clearly visible the winner of the poll--> 
	<div class = "containerBar"> 
		<div class = "bar" > 
			<div class = "progressFill" style = "height: <?php echo $percent1Left?>%;">
			
			</div>
				<span> <?php echo "$percent1%" ?>
				<div> <?php echo "$choice1 <br> Votes: $voted1"; ?> </div>
		</div>
		
		<div class = "bar" > 
			<div class = "progressFill" style = "height: <?php echo $percent2Left?>%;">
				
			</div>
			<span> <?php echo "$percent2%" ?>
			<div> <?php echo "$choice2 <br> Votes: $voted2"; ?> </div>
		</div>
		
		<div class = "bar" > 
			<div class = "progressFill" style = "height: <?php echo $percent3Left?>%;">
				
			</div>
			<span> <?php echo "$percent3%" ?>
			<div> <?php echo "$choice3 <br> Votes: $voted3"; ?> </div>
		</div>
		
		<div class = "bar" > 
			<div class = "progressFill" style = "height: <?php echo $percent4Left?>%;">
				
			</div>
			<span> <?php echo "$percent4%" ?>
			<div> <?php echo "$choice4 <br> Votes: $voted4"; ?> </div>
		</div>
		
		<div class = "bar" > 
			<div class = "progressFill" style = "height: <?php echo $percent5Left?>%;">
				
			</div>
			<span> <?php echo "$percent5%" ?>
			<div> <?php echo "$choice5 <br> Votes: $voted5"; ?> </div>
		</div>
		
		
		<div class = "bar" > 
			<div class = "progressFill" style = "height: <?php echo $percent6Left?>%;">	
			</div>
				<span> <?php echo "$percent6%" ?> </span>
				<div> <?php echo "$choice6 <br> Votes: $voted6"; ?> </div>
		</div>
	</div>


<a href = "/poll/pickPoll.php">
<button id = "graphButton"> Pick Another Poll</button>
</a>



</body>

</html>



<?php

	$con->close();
?>