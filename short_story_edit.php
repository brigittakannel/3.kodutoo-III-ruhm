<?php
	require("/home/brigkann/config.php");
		
	$database = "if16_brigitta";
	
function updateStory($id, $story){
 		
 		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
 		
 		$stmt = $mysqli->prepare("UPDATE story_dump SET story=? WHERE id=?");
		echo $mysqli->error;
 		//var_dump($story, $id, $stmt->execute()); exit;
 		$stmt->bind_param("si", $story, $id);
 		
 		if($stmt->execute()){
 		
 			echo "success";
 		}
 		
 		$stmt->close();
 		$mysqli->close();
 		
}
$asdf = "test text, really random, dont even bother with reading asdasdasdasd qwertyu";
//updateStory(16, $asdf);

function getStory($id) 	{

	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);

	$stmt = $mysqli->prepare("SELECT story FROM story_dump WHERE id=?");
	
	$query = 'SELECT story FROM story_dump WHERE id='.$id;
	
	$stmt->bind_param("i", $id);
	$stmt->bind_result($story);

	$result = mysqli_query($mysqli, $query);
	$story = mysqli_fetch_assoc($result);
	
	return $story['story'];
//var_dump($story['story']); exit;
}

if(isset($_POST['update-btn'])) {
	var_dump($_POST['update-btn']); exit;
	updateStory($_POST['story-id'], $_POST['story']);
}
//var_dump($_POST); exit;
echo '<form method="post" action="short_story_edit.php"><textarea name="story" style="width:500px; height:250px;">'.getStory($_POST['story-id']).'</textarea><br>';
echo '<input type="submit" name="update-btn"></form>';


var_dump(isset($_POST)); exit;




