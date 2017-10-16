<html>
<Head> 
	<title> Home Page </title>
	<link rel="stylesheet" href="CSS/Style.css" />
</head>

<?php include 'header.php'; ?>
<?php include 'CONFIG.php'; ?>

<body> 

</br>
<h2 id=al> Welcome to the web page of <a href="Home.php"> MyBook </a> </h2>

///////////////////////////
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#this function is for older PHP versions that use Magic Quotes.
#
//    function escapestring($input) {
//    if (get_magic_quotes_gpc()) {
//    $input = stripslashes($input);
//   }
//
//    @ $db = new mysqli('localhost', 'root', '', 'testinguser');
//
//
//    return mysqli_real_escape_string($db, $input);
//
//    }

@ $db = new mysqli("127.0.0.1", "root","", "mybook");

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=Home.php>Return to home page </a>");
    exit();
}

    #the mysqli_real_espace_string function helps us solve the SQL Injection
    #it adds forward-slashes in front of chars that we can't store in the username/pass
    #in order to excecute a SQL Injection you need to use a ' (apostrophe)
    #Basically we want to output something like \' in front, so it is ignored by code and processed as text

if (isset($_POST['UserName'], $_POST['Password'])) {
    #with statement under we're making it SQL Injection-proof
    $uname = mysqli_real_escape_string($db, $_POST['UserName']);
    
    #without function, so here you can try to implement the SQL injection
    #various types to do it, either add ' -- to the end of a username, which will comment out
    #or simply use 
    #' OR '1'='1' #
    #$uname = $_POST['username'];
    
    #here we hash the password, and we want to have it hashed in the database as well
    #optimally when you create a user (through code) you simply send a hash
    #hasing can be done using different methods, MD5, SHA1 etc.
    
    $upass = sha1($_POST['Password']);
    
    #just to see what we are selecting, and we can use it to test in phpmyadmin/heidisql
    
   echo "SELECT * FROM user WHERE UserName = '{$uname}' AND Password = '{$upass}'";
    
    $query = ("SELECT * FROM user WHERE UserName = '{$uname}' "."AND Password = '{$upass}'");
       
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result(); 
    
    #here we create a new variable 'totalcount' just to check if there's at least
    #one user with the right combination. If there is, we later on print out "access granted"
    $totalcount = $stmt->num_rows();
    
    
    
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        
        
        if (isset($totalcount)) {
            if ($totalcount == 0) {
                echo '<h2>You got it wrong. Can\'t break in here!</h2>';
            } else {
                echo '<h2>Welcome! Correct password. <a href="UploadPicture.php"> Click here to upload </a></h2>';
            }
        }
        ?>
        <form method="POST" action="">
            <input type="text" name="UserName">
            <input type="password" name="Password">
            <input type="submit" value="Go">
        </form>

    </body>
</html>

///////////////////////////
</body>

<?php include 'footer.php'; ?>

</html>