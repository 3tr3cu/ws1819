<!DOCTYPE HTML>
<HTML>
<head> <title>Consulting Questions</title> 
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
		   <style>body{background-image: url("../images/bg.jpg");background-color: #cccccc;}
		   #feedback{color:rgb(55,176,223);}
		   
		   </style>
		   
	<script src='../js/jquery-3.2.1.js'></script>

	<script>
	    
	    function request(){
	        var sendid = $("#idbox").val();
	        $.ajax({
	            type:"GET",
	            url:"./getQuestionWS.php?id="+sendid,
	            success: function(data){
	               var element = document.getElementById("feedback");
	               element.innerHTML= data;
	            }
	            
	        });
	    }
	    
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


	if (login()){ }else {exit("Not authorized.");}
            

	
	?>
      
  <div id='page-wrap'>
	<header class='main' id='h1'>
          You are currently logged in, <?php echo $_GET['mail'];?>. <span class='right'><a href='.\logOut.php'>Log Out </a> | | <?php	$xml = simplexml_load_file('../xml/counter.xml');
				    	$count = $xml->count;
				    	echo "$count online";?></span>
	<h2>Consulting Questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='./layout.php<?php 
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Home</a></span>
		<span><a href='/quizzes'>Quizzes</a></span>
		<span><a href='./credits.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Credits</a></span>
		<span><a href='.\addQuestion.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Add a question</a></span>
		<span><a href='.\ShowQuestions.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>See the questions (php)</a></span>
		<span><a href='.\showXMLQuestions.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>See the questions (xml)</a></span>
		<span><a href='.\handlingQuizesAJAX.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Manage Quizzes (AJAX)</a></span>
		<span><a href='.\getquest.php<?php
            if (login()){ $usr = trim($_GET['mail']);
		$pass = trim($_GET['pass']); echo "?mail=$usr&pass=$pass";} ?>'>Consult Questions</a></span>
	</nav>
    <section class="main" id="s1">
        
        Question ID: <br>
		<input name="idbox" id="idbox" type="text" required></input> <br>
		<button onclick="request()">Find</button> <br>

	<br> <p id="feedback"></p>
	<br>





    </section>
	
	<footer class='main' id='f1'>
		 <a href='https://github.com/3tr3cu/ws1819'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>