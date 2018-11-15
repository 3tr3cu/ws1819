<!DOCTYPE HTML>
<HTML>
<head> <title>Log out</title> </head>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Logout</title>
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
		   <style>body{background-image: url("../images/bg.jpg");background-color: #cccccc;}</style>
	<script src='../js/jquery-3.2.1.js'></script>

	
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      <span class="right"><a href="./login.php">Log In</a> </span>
      <span class="right"><a href="./signUp.php">Sign up</a> </span>

	<h2>Logged Out</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='./layout.php'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='./credits.php'>Credits</a></span>
		
	</nav>
    <section class="main" id="s1">
	
	<h1 >You have successfully logged out</h1>
	<?php 
    	$xml = simplexml_load_file('../xml/counter.xml');
				    	$count = $xml->count;
				    	$count= intval($count);
				    	$count= $count -1;
				    	$xml= "<counts><count>".$count."</count></counts>";
				    	$xml = new SimpleXMLElement($xml);
				    	$xml->asXML('../xml/counter.xml');
?>
    </section>
	
	<footer class='main' id='f1'>
		 <a href='https://github.com/3tr3cu/ws1819'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>