<?php include('admin/header.php'); 

if ($_GET['function'] != 'download'){
echo "<html>
<head>
<link href='codes.css' rel='stylesheet' type='text/css' />
</head>
<body>
<div align='center'>

<table border='1' width='500' class='bubbly'>";
}

$code = $_GET['code']; 



if (!isset($_GET["function"])){ //as in, if no function has been specified yet..

//check to make sure code entered is valid


$sql = mysql_query("SELECT * FROM album 
WHERE downloadCode = '$code'");
$result = mysql_num_rows($sql); 



if($result == 0 ) {
    echo "<tr><td><h1><center>SORRY!</center></h1>" . $code . " is not a valid code. Have you purchased the album yet? Head over to  <a href='http://vinylcollective.com'>Vinyl Collective</a> to get your copy!<p>";
}

if($result != 0){
    echo "<tr><td>" . $code . " is a valid code..<p>";
} 

//check for remaining downloads
while($row = mysql_fetch_array($sql))
	{
	echo "Code " . $code . " has " . $row['downloadsRemaining'] . " downloads remaining.<p> ";
	if($row['downloadsRemaining'] > 0){
		echo "Thanks for taking the time to check out our album/demo/whatever. To view our onesheet, hear more audio, or check out our current tour schedule, check our main website. <br><br>Click the button below to begin your download. Choose 'Save As' when given the menu, and save the file to somewhere you'll remember (like your desktop).
		<form action='download.php?function=download&code=$code' method='POST'><input name='download' type='submit' value='download' /></form><p>";
		}
	elseif($row['downloadsRemaining'] == 0){
		echo "Sorry, you don't have any more available downloads!<p>";
		}
	}
}
elseif ($_GET["function"] == 'download'){
 	$code = $_GET['code']; 

//	$sql2 = "UPDATE `album` SET `downloadsRemaining` = `downloadsRemaining`-1 WHERE downloadCode = \'" . $code . "\'";
//$sql = 'UPDATE `album` SET `downloadsRemaining` = `downloadsRemaining`-1 WHERE downloadCode = \'abc123\'';
$sql = "UPDATE `album` SET `downloadsRemaining` = `downloadsRemaining`-1 WHERE downloadCode = '$code'";
$result = mysql_query("$sql"); 

$sql = "UPDATE `totals` SET `downloads` = `downloads`+1 WHERE album = 'album'";
$result = mysql_query("$sql"); 


$dir="files/";
$filename="albumTitle.zip";
    $file=$dir.$filename;
    header("Content-type: application/zip");
    header("Content-Transfer-Encoding: Binary");
    header("Content-length: ".filesize($file));
    header("Content-disposition: attachment; filename=\"".basename($file)."\"");
    readfile("$file");
}
?>
