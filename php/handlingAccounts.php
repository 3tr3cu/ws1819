<?php session_start (); ?>
<!DOCTYPE HTML>
<HTML>
<head> <title>Managing Accounts</title> 
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
		   .table-wrapper{width: 90%; overflow: auto;}
		    .navbar-collapse.collapse.in { display: block!important; }
		    #h1{font-size:small}
		   </style>
		   
	<script src='../js/jquery-3.2.1.js'></script>
	<script> 
	<?php
	
	function login()
{
	if(!isset($_SESSION['usr']))
	{

		return false;
	}
	if(!isset($_SESSION['type']))
	{
		if($_SESSION['type']!=1)
		return false;
	}
	
	return true;
		
}  ?>

	
    //http://jsfiddle.net/gSaPb/
	

	
	</script>
	
  </head>
  <body>
      
              <?php


	if (login()){  }else {exit("Not authorized.");}
            

	
	?>
      
  <div id='page-wrap'>
	<header class='main' id='h1'>
          You are currently logged in, <?php echo $_SESSION["usr"];?>. <span class='right'><a href='.\logOut.php'>Log Out </a> | | <?php	$xml = simplexml_load_file('../xml/counter.xml');
				    	$count = $xml->count;
				    	echo "$count online";?></span>
	<h2>Handling Accounts</h2>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Menu</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="layout.php">Home </a>
      <a class="nav-item nav-link" href="#">Quizzes</a>
      <a class="nav-item nav-link" href="credits.php">Credits<span class="sr-only">(current)</span></a>
	  <a class="nav-item nav-link" href="handlingAccounts.php">Manage Accounts</a>
			</div>
		</div>
	</nav>
    </header>

    <section class="main" id="s1">
	
		
			<div class="table-wrapper">
	

	<?php  
  
	include 'dbConfig.php';
	$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);
	
	

	if(!$db)  {
		echo "Database couldn't be connected<br>
Try again by refreshing, or <a href='../layout.html'> go back, please.</a>";
	} else{ 
	    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$izena = $_POST["name"];
			if(isset($_POST["deletBox"])){
				$sql = "DELETE FROM users WHERE mail = '$izena' ";
				$ema = mysqli_query($db,$sql);
				if (!$ema){
					echo "There has been an error. Try again, please.";
				} else {
					echo "Transaction successful";
				}
			} else if (isset($_POST["blockBox"])){
			    
				$sql = "UPDATE users SET Blocked = True WHERE mail = '$izena' ";
				$ema = mysqli_query($db,$sql);
				if (!$ema){
					echo "There has been an error. Try again, please.";
				} else {
					echo "Transaction successful";
				}
			} else {
			    $sql = "UPDATE users SET Blocked = False WHERE mail = '$izena' ";
				$ema = mysqli_query($db,$sql);
				if (!$ema){
					echo "There has been an error. Try again, please.";
				} else {
					echo "Transaction successful";
				    
				}
			}
			
		}
	    
	    $result = mysqli_query($db,"SELECT * FROM users"); 
		if (mysqli_num_rows($result) == 0){
		echo "There is no information to display.";
		}else{
			echo "<table border='1'>
			<col width='130'>
                <col width='80'>
                <col width='90'>
				<tr>
				<th>Izena</th>
				<th>Pasahitza</th>
				<th>&nbsp;Egoera&nbsp;</th>
				</tr>";
				$num = 0;
			while($row = mysqli_fetch_array($result))
			{   if(strpos($row['mail'], 'ikasle') == false)continue;
				if ($row['Blocked']==true){
					$blocked = "checked";
				}else{
					$blocked="";
				} 
				echo "<tr>";
				echo "<td>" . $row['mail'] . "</td>";
				echo "<td><p style='font-size:12px'>" . $row['password'] . "</p></td>";
				echo "<td> <form id='save$num' name='save' method='post'> <input type='checkbox' name='blockBox' $blocked>Block</input><br><input type='checkbox' name='deletBox' >Delete</input><br><input type='submit' id='bttn$num' name='sbmitBttn$num' value='Submit'></input><input type='text' name='name' value='" . $row['mail'] . "' style='display: none'></form></td>";
				echo "</tr>";
				$num++;
			}
			echo "</table>";
	
		}
	mysqli_close($db);}
	?>
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