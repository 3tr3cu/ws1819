<?php
 session_start ();

?><!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quizzes</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='../styles/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='../styles/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='../styles/smartphone.css' />
		   <style>body{background-image: url("../images/bg.jpg");background-color: #cccccc;}
		   .navbar-collapse.collapse.in { display: block!important; }
		   #h1{font-size:small}</style>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
    
      <?php function login()
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
		echo '<span class="right"><a href=".\login.php">Log In</a> </span> | <span class="right"><a href=".\signUp.php">Sign up</a> </span>'; 
	}
        ?>
    
	<h2>Credits</h2>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Menu</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="layout.php">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Quizzes</a>
      <a class="nav-item nav-link" href="credits.php">Credits</a>
	  <?php if(login()){
			if($_SESSION['type']==1){
			echo '<a class="nav-item nav-link" href="handlingQuizesAJAX.php">Manage Quizzes</a>';
			} else if ($_SESSION['type']==2){
			echo '<a class="nav-item nav-link" href="handlingAccounts.php">Manage Accounts</a>';
			}
			
			
		}?>
			</div>
		</div>
	</nav>
    </header>


    <section class="main" id="s1">
    
	<div>
	<h3>Xabier Jimenez</h3>
	Specialized in <b>Software Engineering</b><br>
	<img src='../images/2.jpg' width="200"><br>
	From <b>Donostia </b>
	</div>
	
	<div>
	<h3>Endika Trecu</h3>
	Specialized in <b>Software Engineering</b><br>
	<img src='../images/1.jpg' width="200"><br>
	From <b>Andoain</b>
	</div>
	</section>
	<footer class='main' id='f1'>
		 <a href='https://github.com/3tr3cu/ws1819'>Link GITHUB</a>
	</footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>