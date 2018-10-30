<!DOCTYPE HTML>
<HTML>
<head> <title>Add Questions</title> 
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Add a question</title>
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
	<script> 
		$(document).ready(function(){
			
			$("form").submit(function(e){
				var email = new RegExp('^([a-z]+)([0-9]{3})@ikasle\\.ehu\\.eus$');
				var zailtasuna = new RegExp('^[0-5]$');
				var galdera = new RegExp('^\\S.{9,}$');
				
				var Val = $("#mail").val();
				if (email.test(Val))
				{
					Val = $("#q").val();
					if (galdera.test(Val))
					{
						Val = $("#dif").val();
						if (!zailtasuna.test(Val))
						{
							alert('Invalid difficulty number: choose from 0 to 5');
							e.preventDefault();
						}
						
					}
					else{
					alert('Invalid question: must be at least 10 characters');
					e.preventDefault();
					}
					
				} else {
				alert("Enter a valid ikasle.ehu.eus domain email");
				e.preventDefault();
				}
			
			});
			
		
		});
	
	</script>
	
  </head>
  <body>
      
              <?php
              
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
              
              
              if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            	if (login()){ 
	                
                	}else {exit("Not authorized.");}
            
        } else {exit("Not authorized.");}
	
	?>
      
  <div id='page-wrap'>
	<header class='main' id='h1'>
      You are currently logged in. <span class='right'><a href='.\logOut.php'>Log Out</a> </span>
	<h2>Questions in the database</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='./layout.php<?php if( $_SERVER['REQUEST_METHOD'] == 'GET'){
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";}} ?>'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='./credits.php<?php if( $_SERVER['REQUEST_METHOD'] == 'GET'){
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";}} ?>'>Credits</a></span>
		<span><a href='.\addQuestion.php<?php if( $_SERVER['REQUEST_METHOD'] == 'GET'){
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";}} ?>'>Add a question</a></span>
		<span><a href='.\ShowQuestions.php<?php if( $_SERVER['REQUEST_METHOD'] == 'GET'){
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";}} ?>'>See the questions</a></span>
	</nav>
    <section class="main" id="s1">
        

	
		
	
<?php  
  
  include 'dbConfig.php';
$db = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db);


if(!$db)  { echo "Database couldn't be connected<br>
Try again by refreshing, or <a href='../layout.html'> go back, please.</a>";} 

else{ $result = mysqli_query($db,"SELECT * FROM questions "); 
  
  if (mysqli_num_rows($result) == 0){echo "There is no information to display.";}
  else{ echo "<table border='1'>
<tr>
<th>Mail</th>
<th>Question</th>
<th>Right answer</th>
<th>Wrong answer 1</th>
<th>Wrong answer 2</th>
<th>Wrong answer 3</th>
<th>Difficulty</th>
<th>Subject</th>

</tr>";

while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['mail'] . "</td>";
  echo "<td>" . $row['q'] . "</td>";
  echo "<td>" . $row['respRight'] . "</td>";
  echo "<td>" . $row['respWr1'] . "</td>";
  echo "<td>" . $row['respWr2'] . "</td>";
  echo "<td>" . $row['respWr3'] . "</td>";
  echo "<td>" . $row['dif'] . "</td>";
   echo "<td>" . $row['subj'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

  }
mysqli_close($db);}
  ?>
    </section>
	
	<footer class='main' id='f1'>
		 <a href='https://github.com/3tr3cu/ws1819'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>