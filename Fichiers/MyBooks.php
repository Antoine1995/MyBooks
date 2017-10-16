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



<form action="MyBooks.php" method="POST">
    <table bgcolor="#bdc0ff" cellpadding="6">
        <tbody>
            <tr>
                <td>Title:</td>
                <td><INPUT type="text" name="searchtitle"></td>
            </tr>
            <tr>
                <td>Author:</td>
                <td><INPUT type="text" name="searchauthor"></td>
            </tr>
            <tr>
                <td></td>
                <td><INPUT type="submit" name="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
</form>


<?php
# This is the mysqli version

$searchtitle = "";
$searchauthor = "";

if (isset($_POST) && !empty($_POST)) {
# Get data from form
    $searchtitle = trim($_POST['searchtitle']);
    $searchauthor = trim($_POST['searchauthor']);
}

//	if (!$searchtitle && !$searchauthor) {
//	  echo "You must specify either a title or an author";
//	  exit();
//	}

$searchtitle = addslashes($searchtitle);
$searchauthor = addslashes($searchauthor);

# Open the database
@ $db = new mysqli("127.0.0.1", "root","", "mybook");

if ($db->connect_error) {
    echo "could not connect: " . $db->connect_error;
    printf("<br><a href=Home.php>Return to home page </a>");
    exit();
}

# Build the query. Users are allowed to search on title, author, or both

$query = " select Title, Author, Resrved, ID from book where Resrved is true";
if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " and Title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " and Author like '%" . $searchauthor . "%'";
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " and Title like '%" . $searchtitle . "%' and Author like '%" . $searchauthor . "%'"; // unfinished
}

//echo "Running the query: $query <br/>"; # For debugging


  # Here's the query using an associative array for the results
//$result = $db->query($query);
//echo "<p> $result->num_rows matching books found </p>";
//echo "<table border=1>";
//while($row = $result->fetch_assoc()) {
//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
//}
//echo "</table>";
 

# Here's the query using bound result parameters
    // echo "we are now using bound result parameters <br/>";
    $stmt = $db->prepare($query);
    $stmt->bind_result($Title, $Author, $Resrved, $ID);
    $stmt->execute();
    
//    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
//    $stmt2->bind_result($onloan, $bookid);
    

    echo '<table bgcolor="dddddd" cellpadding="6">';
    echo '<tr><b><td>BookID</td><b> <td>Title</td> <td>Author</td> <td>Reserved?</td> </b> <td>Return</td> </b></tr>';
    while ($stmt->fetch()) {
        if($Resrved==1)
            $Resrved="Yes";
       
        echo "<tr>";
        echo "<td> $ID </td><td> $Title </td><td> $Author </td><td> $Resrved </td>";
        echo '<td><a href="UnbookPage.php?bookid=' . urlencode($ID) . '">Return</a></td>';
        echo "</tr>";
        
    }
    echo "</table>";
    ?>


</body>

<?php include 'footer.php'; ?>

</html>