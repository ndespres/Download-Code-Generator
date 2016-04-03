<?php include('header.php'); 


$numCodes = $_POST['numCodes']; 
$numDownloads = $_POST['numDownloads']; 


$counter = $numCodes;

function random_generator($digits){
srand ((double) microtime() * 10000000);
//Array of alphabets
$input = array ("A", "B", "C", "D", "E","F","G","H","I","J","K","L","M","N","O","P","Q",
"R","S","T","U","V","W","X","Y","Z");

$random_generator="";// Initialize the string to store random numbers
for($i=1;$i<$digits+1;$i++){ // Loop the number of times of required digits

if(rand(1,2) == 1){// to decide the digit should be numeric or alphabet
// Add one random alphabet
$rand_index = array_rand($input);
$random_generator .=$input[$rand_index]; // One char is added

}else{

// Add one numeric digit between 1 and 10
$random_generator .=rand(1,10); // one number is added
} // end of if else

} // end of for loop

return $random_generator;
} // end of function


$gen = random_generator(10);

echo("generating ". $counter . " codes .. <br>");

while ( $counter > 0 ) {

//$result = mysql_query("INSERT INTO `code`.`album` (`downloadCode`, `downloadsRemaining`) VALUES ('" . random_generator(10) . "', '$numDownloads')")

$result = mysql_query("INSERT INTO ".$db_name.".`album` (`downloadCode`, `downloadsRemaining`) VALUES ('" . random_generator(10) . "', '$numDownloads')")
or die(mysql_error());


	$counter = $counter - 1;

	}

//end function 'generate
echo ("all set!");


?>
