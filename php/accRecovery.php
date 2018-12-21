<?php
 session_start ();

?><!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Acc. Recovery</title>
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
    
    <span class="right"><a href=".\login.php">Log In</a> </span>| <span class="right"><a href=".\signUp.php">Sign up</a> </span>
    
	<h2>Account Recovery</h2>
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
    
	
<div>
    A message will be sent to your e-mail address with the "secret code".
    <br>
	<br>

	<form id="rec" name="rcv" method="get">
	<label>E-mail address</label>
	<input name="mail" id="mail" type="text" required></input> <br> <br>
	<input type="submit" id="recoverbtn"></input>  <br>
	
	</form>
	
	<?php 
	
	 include 'dbConfig.php';
	 
    	if(!empty($_GET['mail'])){
	    
    		$usr = trim($_GET['mail']);
	    	$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
		    $sql = "SELECT * FROM users WHERE mail ='$usr' ";
		    $result = mysqli_query($db,$sql); 
		    $resultCheck = mysqli_num_rows($result);
		
		    if ($resultCheck <1)
		    {
			    echo ("That user does not exist.");
			    
		    }else{
		        $sql = "SELECT * FROM recovery WHERE email ='$usr' ";
		        $result = mysqli_query($db,$sql); 
		        $resultCheck = mysqli_num_rows($result);
		
	            if (!($resultCheck <1))
		        {
			        $sql = "DELETE FROM recovery WHERE email = '$usr' ";
			        $ema = mysqli_query($db,$sql);

		        }
		        $isnewcode = false;
		        $code = rand(00000000,99999999);
		        while (!$isnewcode){
                    $sql = "SELECT * FROM recovery WHERE number ='$code' ";
		            $result = mysqli_query($db,$sql); 
		            $resultCheck = mysqli_num_rows($result);
		            if (!($resultCheck <1)){
		                $code = rand(00000000,99999999);
		            }
		            else $isnewcode=true;
		        }
		        $sql ="INSERT into recovery (number, email) values ($code,'$usr')";
		        $ema = mysqli_query($db,$sql);
		        if (!$ema){
						echo "There has been an error. Try again, please.";
						} else {
						echo "<br><p style='color:blue;'>Code generated and saved. It will be sent to your account shortly.</p> <b>Make sure to check the spam folder too.</b><br>";
						$subj = "ws842134 Login Information: Password reset";

                        $msg="<html>
                            <head>
                                <title>Password Reset</title>
                            </head>
                            <body>
                            <h3>Password reset instructions:</h3>.
                            Your password reset code is: $code.
                            Click <a href='http://ws842134.000webhostapp.com/projectfinal/php/accRecovery.php'>here</a> to go to the recovery page, or get back there manually. <br>
                            <br>
                            Remember this is a <b>one use</b> code, and it will be deleted upon use. You may request another one then.
                            </body>
                        </html>";
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .='From: noreply@WS17.com'. "\r\n";
						$done =mail($usr,$subj,$msg,$headers);
						if($done){echo "Sent successfully!";}else{
						   echo "Error sending";
						}
					}
			mysqli_close($db);  
		    }
		
	    
    	}
	
	?>
    <br> If you already have acquired a code, enter it here:
    <br><br>
    <form id="change" name="change" method="get">
    <label>Secret Code</label>
    <input name="cod" id="cod" type="number"> <br> <br>
    	<input type="submit" id="changebtn"></input>
    </form>
    <?php 
    
    
    $scs = false;
    include 'dbConfig.php';
    if(!empty($_GET['cod'])){
        $kod=$_GET['cod'];
        $db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
        $sql = "SELECT * FROM recovery WHERE number =$kod ";
	    $result = mysqli_query($db,$sql); 
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck <1){
		    echo "Incorrect code.";
		}else{
		    $datuak=mysqli_fetch_assoc($result);
		    $mail = $datuak['email'];
		    $sql= "DELETE FROM recovery WHERE number=$kod";
		    $ema = mysqli_query($db,$sql);
		    if (!$ema){
				echo "There has been an error. Try again, please.";
			} else {
                echo "<script>window.location = './passChange.php?cod=$kod&mail=$mail'</script>";
			}

        }
        mysqli_close($db);   
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