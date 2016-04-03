<?php include('header.php'); 


$codeText = $_POST['codeText']; 
$numDownloads = $_POST['numDownloads']; 




//$result = mysql_query("INSERT INTO `code`.`album` (`downloadCode`, `downloadsRemaining`) VALUES ('" . random_generator(10) . "', '$numDownloads')")

$result = mysql_query("INSERT INTO ".$db_name.".`album` (`downloadCode`, `downloadsRemaining`) VALUES ('$codeText', '$numDownloads')")
or die(mysql_error());



//end function 'generate
echo ("All set! Code generated for ".$codeText." with ".$numDownloads." downloads. You'll want to send them a link to <a href='http://whatever.com/download.php?code=".$codeText."'>http://whatever.com/download.php?code=".$codeText."</a>.");


?>
