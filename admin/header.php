<?php
include("vars.php");
mysql_connect("$server", "$db_user","$db_pass") or
        die ("Could not connect to database");
mysql_select_db("$db_name") or
        die ("Could not select database");
?>
