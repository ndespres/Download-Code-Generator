1. Create a new database, and a new user. Assign appropriate permissions. 
   This is pretty easy to do through cPanel, ask me if you need help.
2. Open PHPMyAdmin. In the left column, click on the database you just created.
3. Click the Query button on the top right. 
   You'll see a text box titled "SQL query on database." 
   Take the entire contents of the SQLdata.txt file, copy it into that box, 
   and hit Submit Query.
4. Assuming that went without a hitch.. open the 'vars.php' file in Notepad, 
   edit the values in there with what you did in step 1.
5. Upload everything to the webz. 
6. Done!
7. To customize how the printouts are going to look, open admin.php and look about halfway
   down the page. Edit index.php to edit the main page.
8. To customize the rest of the error messages/download links/etc, look in codeCheck.php.