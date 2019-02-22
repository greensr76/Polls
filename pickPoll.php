<?php

$con  = new mysqli('localhost', 'root', '', 'dbpoll');
if (!$con ) {
    die('Could not connect: ' . mysqli_error());
}
	//Query to get all the poll names
	$sql = "SELECT * FROM answers";
	$result = $con->query($sql);
	
	//Stored all found results in array polls
	while($row = mysqli_fetch_array($result)) {
		$polls[] = $row;
	}
	

?>	





<html>
<head>
<link rel = "stylesheet" href = "fancyPoll.css" >

</head>

<body>
<h1 style = "fontstyle: bold"> All Polls:</h1>



<?php if (!empty($polls)): ?>
	
	<!-- Loop through each item of array to create link with each poll's question names
	will send poll ID of clicked link to the voting page so that page will know which poll to load from--> 
	<ul>
		<?php foreach($polls as $poll): ?>
			<li class = "pollName"><a href = "vote.php?id=<?php echo $poll['IDpoll'];?>" ><?php echo $poll['qName'] ?> </a></li>
		<?php endforeach; ?>
	</ul>
		
<?php else: ?>
	<p> No Polls Available at the Moment </p>

<?php endif; ?>



<a href = "/poll/pollHome.html">
<button > Home</button>
</a>



</body>

</html>


<?php
	$con->close();
?>