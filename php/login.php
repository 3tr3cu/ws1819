<?php
 session_start ();
?>
<!DOCTYPE html>
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
    
    <span class="right"><a href=".\login.php">Log In</a> </span>| <span class="right"><a  href=".\signUp.php">Sign up</a> </span>
    
	<h2>Log In</h2>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Menu</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="layout.php">Home</a>
      <a class="nav-item nav-link" href="#">Quizzes</a>
      <a class="nav-item nav-link" href="credits.php">Credits</a>

			</div>
		</div>
	</nav>
    </header>


    <section class="main" id="s1" >
    
	
<div style="text-align: center;" >

	
	<div  class="form-border"  >
	<form id="log" name="log" method="get">
	
	<div class="form-group">
	<label for="mail" >E-mail address:</label>
	<input class="form-control" placeholder="Enter your email" name="mail" id="mail" type="text" required></input> 
	</div>

	 <div class="form-group">
	<label for="pass">Password:</label>
	<input class="form-control" placeholder="Enter your password"  name="pass" id="pass" type="password" required></input>
	</div class="sa">

	
	<button type="submit" id='login' class="btn btn-primary">Login</button>
	
	</form>
    <br>
 <a href='accRecovery.php'><u>Forgot your password?</u></a>
</div>
</div>


<?php  
  
  
  include 'dbConfig.php';
  
	function login()
	{
	if(empty($_GET['mail']))
	{

		return false;
	}
	if(empty($_GET['pass']))
	{

		return false;
	}
	
	return true;
		
	}  




if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
	if (login())
	{
		$usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']);
		
		$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
		$sql = "SELECT * FROM users WHERE mail ='$usr' ";
		$result = mysqli_query($db,$sql); 
		$resultCheck = mysqli_num_rows($result);
		
		if ($resultCheck <1)
		{
			echo ("That user does not exist.");
			exit();
		}
		else
		{
			if($datuak=mysqli_fetch_assoc($result))
			{ $auth = password_verify($pass,$datuak["password"]);
				if (!$auth)
				{
					echo ("That password is incorrect");
					exit();
				}
				else{
				    
				    $xml = simplexml_load_file('../xml/counter.xml');
				    $count = $xml->count;
				    $count= intval($count);
				    $count++;
				    $xml= "<counts><count>".$count."</count></counts>";
				    $xml = new SimpleXMLElement($xml);
				    $xml->asXML('../xml/counter.xml');
				        
					$_SESSION["usr"]= $usr;
					if(strpos($usr, 'ikasle') !== false){
						$type = 1; //ikasle
					} else {
						$type = 2; //admin
					}
					$_SESSION["type"]= $type;
				    if ($type== 1){
						echo "<script>window.location = './handlingQuizesAJAX.php'</script>";
					} else if ($type == 2){
						echo "<script>window.location = './handlingAccounts.php'</script>";
					}
				}
			}
		}

		mysqli_close($db);
	}

}	
  


  ?>
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