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
</br>
</br>

<p> Thank you for booking ! </p>
<form action="Browse.php" id=al>
  <input type="submit" value="Browse again">
</form>

</br>
</br>


<?php

@ $db = new mysqli("127.0.0.1", "root","", "mybook");

$ID = trim($_GET['bookid']);
echo '<INPUT type="hidden" name="bookid" value=' . $ID . '>';

$ID = trim($_GET['bookid']);      // From the hidden field
$ID = addslashes($ID);



    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=Home.php>Return to home page </a>");
        exit();
    }
    
   echo "You are reserving book with the ID:"           .$ID;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE book SET Resrved=1 WHERE ID = ?");
    $stmt->bind_param('i', $ID);
    $stmt->execute();
    printf("<br>Book Reserved!");
    printf("<br><a href=Browse.php>Search and Book more Books </a>");
    printf("<br><a href=MyBooks.php>Return to Reserved Books </a>");
    printf("<br><a href=Home.php>Return to home page </a>");
    exit;
    

?>

</body>

<?php include 'footer.php'; ?>

</html>