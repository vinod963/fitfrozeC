<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=fitfroze", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}

	
	include_once 'constants.php';
	extension_loaded('ffmpeg');
	
	$sourcePath = $_POST["sourcePath"];
	$sourcePath = ltrim($sourcePath,'/');
	$myid = (gettype($_POST["songartist"]) == 'integer') ? $_POST["songartist"] : (int)$_POST["songartist"];
	
	$startTime = $_POST['startTime'];
	$endTime  = $_POST['endTime'];
	$path2 = "uploads/cuts/";
	
	$destinationPath = $path2.str_replace('.','',microtime(true)).'_'.basename($sourcePath);	
	$sql = "UPDATE ".DBPREFIX.MP3TABLE." SET mp3ringtone='/$destinationPath' WHERE mp3source_id=$myid";
		
	// Prepare statement
	$stmt = $conn->prepare($sql);	
	// execute the query
	$stmt->execute();
	
	// echo a message to say the UPDATE succeeded
	//echo $stmt->rowCount() . " records UPDATED successfully";exit;
		
	exec ("ffmpeg -i $sourcePath -ss $startTime -t $endTime -vcodec copy -acodec copy $destinationPath");
	
	
	$myid = base64_encode($myid);
	$myheader = '/ringtones/ownringtone/'.$myid;
	
	$conn = null;
	
	header("location: $myheader");
?>