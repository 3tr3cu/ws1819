<?php session_start (); ?>
<!DOCTYPE HTML>
<HTML>
<head> <title>Managing Questions</title> 
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add a question</title>
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
		   #feedback{color:rgb(55,176,223);}
		   .table-wrapper{ width: 90%; overflow: auto;}
		   table {
    margin-left:auto; 
    margin-right:auto;
  }
tbody{
  display:block;
  overflow:auto;
  height:200px;
  width:100%;
}
thead tr{
  display:block;
}
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
			if($_SESSION['type']!=1)	return false;
		}
	return true;
	}  
	?>
        window.onload = function() {
    $.ajax({
				    type: "GET",
					url: "./questcounter.php", success: function(data){
	                 
									$("#questcounter").html(data);

	                 
								}
							});
    };
	    window.setInterval(function(){ 
	        $.ajax({
				    type: "GET",
					url: "./questcounter.php", success: function(data){
	                 
									$("#questcounter").html(data);

	                 
								}
							});
        
    }, 20000);
    //javascript atala
	
		function checkandsend(str1, str2){
			    
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
						} else{
						    // bidali
						    
						    xhro = new XMLHttpRequest();
                            xhro.onreadystatechange=function(){
                            if (xhro.readyState==4 && xhro.status==200)
                                 {document.getElementById("feedback").innerHTML=xhro.responseText; }
							}
						    
						    xhro.open("POST", "addQuestionAJAX.php",false);
                            xhro.setRequestHeader("Content-type",
"application/x-www-form-urlencoded");
                            var email= document.getElementById("mail").value;
                            var quest= document.getElementById("q").value;
                            var RR= document.getElementById("respRight").value;
                            var RW1= document.getElementById("respWr1").value;
                            var RW2= document.getElementById("respWr2").value;
                            var RW3= document.getElementById("respWr3").value;
                            var RW1= document.getElementById("respWr1").value;
                            var DIF= document.getElementById("dif").value;
                            var sbj= document.getElementById("subj").value;
                            
                            var params="mail="+email+"&q="+quest+"&respRight="+RR+"&respWr1="+RW1+"&respWr2="+RW2+"&respWr3="+RW3+"&dif="+DIF+"&subj="+sbj;
		
                            xhro.send(params);
                            
	                        $.ajax({
				            type: "GET",
				        	url: "./questcounter.php", success: function(data){
	                 
							$("#questcounter").html(data);
                            	}
							});
        
                                                                        
                            
                            $.ajax({
								type: "GET",
								url: "./showXMLQuestionsAJAX.php", success: function(data){
	                 
									$("#tablearea").html(data);

	                 
								}
							});
						}
						
					}
					else{
					alert('Invalid question: must be at least 10 characters');
					
					}
					
				} else {
				alert("Enter a valid ikasle.ehu.eus domain email");
				
				}
			}
			
		
	
	</script>
	
  </head>
  <body>
      
              <?php


	if (login()){ }else {exit("Not authorized.");}
            

	
	?>
      
  <div id='page-wrap'>
	<header class='main' id='h1'>
          You are currently logged in, <?php echo $_SESSION["usr"];?>. <span class='right'><a href='.\logOut.php'>Log Out </a> | | <?php	$xml = simplexml_load_file('../xml/counter.xml');
				    	$count = $xml->count;
				    	echo "$count online";?></span>
	<h2>Handling Quizzes</h2>
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
	  <a class="nav-item nav-link" href="handlingQuizesAJAX.php">Manage Quizzes</a>
			</div>
		</div>
	</nav>
    </header>

    <section class="main" id="s1">
        

	

	
			<input name="mail" id="mail" type="text" value=<?php $usr =trim($_SESSION['usr']); echo "$usr";?> style="display: none" required></input>
		
			Question:(*) <br>
			<input name="q" id="q" type="text" required></input> <br>
			
			Right Answer:(*) <br>
			<input name="respRight" id="respRight" type="text" required></input> <br>
			Wrong Answer 1:(*) <br>
			<input name="respWr1"  id="respWr1" required></input> <br>
		
			Wrong Answer 2:(*) <br>
			<input name="respWr2" id="respWr2" required></input> <br>
			
			Wrong Answer 3:(*) <br>
			<input name="respWr3" id="respWr3" type="text" required></input> <br>
		
			Difficulty:(*) <br>
			<input name="dif" id="dif" type="number" required></input> <br>
			
			Subject:(*) <br>
			<input name="subj" id="subj" type="text" required></input> <br>
			
			(Fields marked as (*) are mandatory) <br>
	
			<button onclick="checkandsend()">Send</button> <br>
		
	<br> <p id="questcounter"></p>
	<br> <p id="feedback"></p>
	<br>
	    <button id="getbyuser">Show your questions</button>
	    <script>
	        
	        	//jquery atala
	 $(document).ready(function(){
	     
	     $("#getbyuser").click(function(){
	         $.ajax({
	             type: "GET",
	             url: "./showXMLQuestionsAJAX.php", success: function(data){
	                 
	                 $("#tablearea").html(data);

	                 
	             }
	         });
	         
	     });
	 });
	        
	    </script>
	
	    <div class="table-wrapper">
	        <div id="tablearea"></div>
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