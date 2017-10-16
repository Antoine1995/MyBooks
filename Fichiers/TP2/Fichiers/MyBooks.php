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

<p>
This is the books you have already booked :
	<ul>
		<li> 20 miles under the sea </a> </li> </br>
				<form action="Home.php" id=al>
				<input type="submit" value="Unbook it !"> </form>
		<li> 1984 </a> </li>
				<form action="Home.php" id=al>
				<input type="submit" value="Unbook it !"> </form>
	</ul>
</p>

<?php echo $current_page ?>

</body>

<?php include 'footer.php'; ?>

</html>