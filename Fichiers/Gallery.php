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

<p> To upload an image, please first <a href="Log.php"> log in </a> <p>

<p>//////////////////</p>

<?php
$dirname = "uploadedfiles/";
$images = glob($dirname."*.*");

foreach($images as $image) {
    echo '<img src="'.$image.'" /><br />////////////////////////////////////////////<br/>';
}
?>

<p>//////////////////</p>
</body>

<?php include 'footer.php'; ?>

</html>