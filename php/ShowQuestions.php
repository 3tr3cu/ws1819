

<!DOCTYPE html>
<HTML>
<head> <title>Show Questions</title> </head>
<body>

<h1>Database Questions</h1>

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

echo "<a href=../layout.html> Back to layout. </a>";
  }
mysqli_close($db);}
  ?>

</body>
</HTML>