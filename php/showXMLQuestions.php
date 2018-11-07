<!DOCTYPE HTML>
<HTML>
<head> <title>Add Questions</title> 
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Show Questions</title>
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
      You are currently logged in, <?php echo $_GET['mail'];?>. <span class='right'><a href='.\logOut.php'>Log Out</a> </span>
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
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";}} ?>'>See the questions (php)</a></span>
		<span><a href='.\showXMLQuestions.php<?php if( $_SERVER['REQUEST_METHOD'] == 'GET'){
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";}} ?>'>See the questions (xml)</a></span>
	</nav>
    <section class="main" id="s1">
        

	
		
	
<?php  
  
$xml = simplexml_load_file("../xml/questions.xml");



if(!$xml)  { echo "No xml file was found<br>
Try again by refreshing, or <a href='./layout.php'> go back, please.</a>";} 

else{ if(empty($xml->children())) {
  
 echo "There is no information to display.";}
  else{ echo "<table border='1'>
<tr>
<th>Mail</th>
<th>Question</th>
<th>Right answer</th>

</tr>";

foreach ($xml->children() as $ai){

  echo "<tr>";
  echo "<td>" . $ai['author'] . "</td>";
  echo "<td>" . $ai->itemBody->p . "</td>";
  echo "<td>" . $ai->correctResponse->value . "</td>";
  echo "</tr>";
  }
echo "</table>";

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