<?php session_start (); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
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
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
    
      <?php 	function login()
{
	if(!isset($_SESSION['usr']))
	{

		return false;
	}
	if(!isset($_SESSION['type']))
	{
		
		return false;
	}
	
	return true;
		
	}
	

	if (login()){
		$usr = trim($_SESSION['usr']);
		echo "You are currently logged in, $usr. <span class='right'><a href='.\logOut.php'>Log Out</a> </span>";
    } else {
		echo '<span class="right"><a href=".\login.php">Log In</a> </span><span class="right"><a href=".\signUp.php">Sign up</a> </span>'; 
	}
	          
	?>
    
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='credits.php'>Credits</a></span>
		<?php if(login()){
			if($_SESSION['type']==1){
echo "<span><a href='.\handlingQuizesAJAX.php'>Manage Quizzes (AJAX)</a></span>";
			} else if ($_SESSION['type']==2){
				echo "
		<span><a href='.\handlingAccounts.php'>Manage Accounts</a></span>";
			}
			
			
		}?>
		

	</nav>
    <section class="main" id="s1">
    
	
	<div>
	Quizzes and credits will be displayed in this spot in future laboratories ...
	</div>
    </section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/3tr3cu/ws1819'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>