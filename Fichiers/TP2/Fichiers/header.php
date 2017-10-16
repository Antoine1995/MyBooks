<header> 
<?php include 'CONFIG.php'; ?>
<p>		
	<div id="main_menu">
		<ul id=index>
			<li id=al> <a class="<?php echo ($current_page == 'Home.php' || $current_page == '') ? 'active' : NULL ?>" href="Home.php"> Home </a> </li> </br>
			<li id=al> <a class="<?php echo ($current_page == 'AboutUs.php' || $current_page == '') ? 'active' : NULL ?>" href="AboutUs.php"> About us </a> </li></br>
			<li id=al> <a class="<?php echo ($current_page == 'Browse.php' || $current_page == '') ? 'active' : NULL ?>" href="Browse.php"> Browse </a> </li></br>
			<li id=al> <a class="<?php echo ($current_page == 'MyBooks.php' || $current_page == '') ? 'active' : NULL ?>" href="MyBooks.php"> My books </a> </li></br>
			<li id=al> <a class="<?php echo ($current_page == 'Contact.php' || $current_page == '') ? 'active' : NULL ?>" href="Contact.php"> Contact </a> </li></br>
		</ul>
	</div>
</p>

<p id=al>
			<img src="Images/bookgif.gif" alt="wow" />
</p>
		

</header> 