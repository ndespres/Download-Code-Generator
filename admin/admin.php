<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Code Generation</title>
</head>

<body>
<?php 

include('header.php'); 

//check to see if we want to show all codes..
if ($_GET["function"] == 'showall'){
//open up the table for the album we're working with
$result = mysql_query("SELECT * FROM album ORDER BY timeCreated");

//show all the content in a table
echo "
<table border='1'><tr>
<td>code</td>
<td>downloads left</td>
<td>time created</td>
<td>download url</td></tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr><td>" . $row['downloadCode'] . " </td><td align='right'> " . $row['downloadsRemaining'] . "</td><td>" . $row['timeCreated'] . "</td><td><a href='http://mynameisneil.com/projects/codes2/download.php?code=" . $row['downloadCode'] ."'>http://mynameisneil.com/projects/codes2/download.php?code=" . $row['downloadCode'] ."</a></tr>";
  }
}

elseif ($_GET["function"] == 'print'){
$result = mysql_query("SELECT * FROM album ORDER BY timeCreated");

//show all the content in a table

echo ("<table border='1' cols='2'><tr>");
  $a=0;

while($row = mysql_fetch_array($result))
 
  {
	  //HERE IS WHERE YOU CUSTOMIZE HOW THE PRINTOUTS ARE GOING TO LOOK!
	  //the only thing you dont want to mess with is the $row[downloadcode] part
	  //if you're going to use quotes, put a \backslash before them! as in..
	  //Rolling Stone says this album is \"The Very Bestest of 2k8!\"
echo "
	<td width='500'>
	<center>
	THANKS FOR PURCHASING<BR>
	<font size='+1'>ALBUM TITLE</font><br>
	by SOME BAND<br>
	To download high-quality MP3s of this album for free, head to http://www.whatever.com 
	and enter the following code: <br><br><font size='+1'>
	" . $row['downloadCode'] . " </font><br> 
	Thanks for your support!</td>";
  	$a=$a+1;
		if($a==2){
		$a=0;
		echo "</tr><tr>";
		}
  }
}

elseif ($_GET["function"] == 'generate'){
?>
<div align="center">
<table border="1">
<tr><td>
  <p>How many codes would you like to generate?</p>
  <form id="form1" name="form1" method="post" action="generator.php?function=generate">
    number of codes:
      <input name="numCodes" type="text" value="10" />
  
    <p>number of downloads per code:
      <input name="numDownloads" type="text" value="1" />
  </p>
    <p>
      <input type="submit" name="Submit" value="Submit" />
</p>
  </form>
 </td></tr></table>
 

</div>
<?php }

elseif ($_GET["function"] == 'custom'){
?>
<div align="center">
<table border="1">
<tr><td>
  <p>You'd want to use this function to generate a single code you can use to identify who you're sending it to track how
  	if they've used it, how many times they've used it, etc). For example, if you were sending out a download link to 
  	a magazine, you could create the code MAXRNR to keep tabs on whether Maximum Rock n Roll checked your link out.
  <p>Unique code name</p>
  <form id="form1" name="form1" method="post" action="custom.php?function=generate">
    code text
      <input name="codeText" type="text" />
  
    <p>number of downloads for this code:
      <input name="numDownloads" type="text" value="10" />
  </p>
    <p>
      <input type="submit" name="Submit" value="Submit" />
</p>
  </form>
 </td></tr></table>
 

</div>
<?php }



if (!isset($_GET["function"])){ //as in, if no function has been specified yet..
$sql = "SELECT * FROM totals 
WHERE album = 'album'";
$query = mysql_query($sql); 
while($row = mysql_fetch_array($query))
  {
  echo "There have been <b>" . $row['downloads'] . "</b> downloads of your album so far.<p>";
  }
  
echo("Admin Options:
<li><a href='?function=generate'>Generate <i>n</i> random codes</a>
<li><a href='?function=custom'>Create custom codes</a>
<li><a href='?function=showall'>Show All Codes/Remaining Downloads</a>
<li><a href='?function=print'>Print download coupons</a><p>



Obviously, this page would be password-protected, and the link wouldn't be visible from the main page :)");
}

?>
</body>
</html>
