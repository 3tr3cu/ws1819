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
		   .important {text-decoration: underline;}
		   .navbar-collapse.collapse.in { display: block!important; }
		   #h1{font-size:small}</style>
		   	<script src='../js/jquery-3.2.1.js'></script>
		   	<script> 

	var validPass;
	
		$(document).ready(function(){
			
			$("form").submit(function(e){

				var pasahitza = new RegExp('^\\S.{7,}$');
				
				var p1 = $("#p").val();
				var p2 = $("#p2").val()
				
				if (p1 == p2){
				
				    Val = $("#p").val();
					if (!pasahitza.test(Val))
					{
					    alert('Invalid password. Must be at least 8 characters long without spaces.');
						e.preventDefault();
					} else if (validPass==false){
						    
					    alert('Try a safer password.');
						e.preventDefault();
					}
			
				} else {
					alert("The two passwords don't match.");
				e.preventDefault();
				}
			});
			
		
		});
		

	function ispassok(){
		$.ajax({
			type: "GET",
			url: "./egiaztatuPasahitza.php?pass="+$("#p").val(),
			success: function(data){
				if (data=="BAI"){
					$("#passvalidation").text("");
					validPass=true;
				}
				else if(data=="EZ"){
					$("#passvalidation").text("Service denied");
					validPass=false;
				}
				else if (data="EZ2"){
				    $("#passvalidation").text("Not safe enough of a password.");
					validPass=false;
				}
				else if (data="DC") {
					$("#passvalidation").text("Validation failed due to external circumstances.");
					validPass=false;
				}
			}
		});
	}
	
	</script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
    
    <span class="right"><a href=".\login.php">Log In</a> </span> | <span class="right"><a href=".\signUp.php">Sign up</a> </span>
    
	<h2>Password Reset</h2>
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



    <section class="main" id="s1">
        
        <p class="important">Remember: if you leave this page, you will have to request the code again!</p> 
        <br>
        <p> Insert a new password (at least 8 characters long, NO SPACES).</p>
	    
		<form id="reset" name="reset" method="post">
	
            New Password: <br>
			<input name="p" id="p" type="password" onchange="ispassok()" required></input> <br> <br>
			
			Confirm password: <br>
			<input name="p2" id="p2" type="password" required></input> <br> <br>
			
            <input type="hidden" id="mail" name="custId" value="<?php if (!($_SERVER['REQUEST_METHOD'] == 'POST')){
            
                if (!empty($_GET['mail'])){
                     $usr = $_GET['mail'];
                    echo"$usr";}
            } ?>">
	
			<input type="submit" id="bttn" name="sbmitBttn" value="Submit"></input><br> <br>
		
	</form>

			<p style="color:red" id="passvalidation"></p>

	
	<?php 

include 'dbConfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{	

		$varP = $_POST['p'];
		
		$validData= false;
		

		if(preg_match('/^\\S{8,}$/',$varP)){
					
					$validData=true;		
				}
		
	
		if (!$validData){echo"No cheating!";} else {
		    
			
				$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
				if (!$db){
					echo "Problem accessing the database. Try again, please.";}
				else{
				    $hash = password_hash($_POST['p'], PASSWORD_BCRYPT);
					$sql = "UPDATE users set password ='$hash'";
					$ema = mysqli_query($db,$sql);
					if (!$ema){
						echo "There has been an error. Try again, please.";
						} else {
						echo "<script>window.location = './pscgSuccess.php'</script>";
					}
				}
				mysqli_close($db);
			
		} 
} else {
    if(empty($_GET['mail'])||empty($_GET['cod'])){
        exit("Not Authorized");
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