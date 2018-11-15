<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Log in</title>
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
	    
    <span class="right"><a href=".\login.php">Log In</a> </span><span class="right"><a href=".\signUp.php">Sign up</a> </span>
    

	<h2>Log in</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='.\layout.php'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='.\credits.php'>Credits</a></span>

	</nav>
    <section class="main" id="s1">
    
	<div>
	<h3>User Identification</h3>
	

	<form id="log" name="log" method="get">
	<label>E-mail address:</label>
	<input name="mail" id="mail" type="text" required></input> <br> <br>
	<label>Password:</label>
	<input name="pass" id="pass" type="password" required></input> <br> <br>
	<input type="submit" id="login"></input>  <br>
	
	</form>
    


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
			{
				if ($pass != $datuak["password"])
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
				        
				    
				    
					echo "<script>window.location = './layout.php?mail=$usr&pass=$pass'</script>";
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
</body>
</html>