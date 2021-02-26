<html>
 <head>
  <title>PHP Test</title>
 </head>
 <link rel="stylesheet" type="text/css" href="table.css">
 <link rel="stylesheet" type="text/css" href="form.css">
 
 <style>
 form{
	 background-color: green;
	 width:30%;
 }
 input[type=text] {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}
 </style>

 <body>
 

 
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 


$fnameErr = $lnameErr = $ftelErr = $fadressErr = $lageErr ="";
$fname = $lname = $ftel = $fadress = $lage = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["fname"])) {
    $fnameErr = "Vārds nav ievadīts";
  } else {
	$fname = mysqli_real_escape_string($conn, $_POST["fname"]);
   
	 
  }

  if (empty($_POST["lname"])) {
    $lnameErr = "Uzvārds nav ievadīts";
  } else {
	  $lname = mysqli_real_escape_string($conn, $_REQUEST['lname']);
    
	 
  }

  if (empty($_POST["ftel"])) {
    $ftelErr = "Telefons nav ievadīts";
  } else {
	  $ftel = mysqli_real_escape_string($conn, $_REQUEST['ftel']);

	if (!preg_match('/^[0-9]{8}+$/', $ftel)) {
      $ftelErr = "Nav 8 cipari";
    }
	 
  }

  if (empty($_POST["fadress"])) {
    $fadressErr = "Adrese nav ievadīta";
  } else {
	 $fadress = mysqli_real_escape_string($conn, $_REQUEST['fadress']);
 
	 
  }

  if (empty($_POST["lage"])) {
    $lageErr = "Vecums nav ievadīts";
  } else {
	  $lage = mysqli_real_escape_string($conn, $_REQUEST['lage']);

	 
  }
  $sql = "INSERT INTO kontakti (vards, uzvards, telefons, adrese, vecums) VALUES ('$fname', '$lname', '$ftel', '$fadress','$lage')";
if(mysqli_query($conn, $sql)){
    echo "Ieraksti ir pievienoti";
} else{
    echo "ERROR: $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
}


 
?>

<h1>Ievadiet datus</h1>
 
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label class= "label1" for="fname">Vārds:</label><br>
  <input type="text" id="fname" name="fname">
  <span class="error">* <?php echo $fnameErr;?></span>
<br><br>
  <label for="lname">Uzvārds:</label><br>
  <input type="text" id="lname" name="lname">
  <span class="error">* <?php echo $lnameErr;?></span>
<br><br>
  <label for="ftel">Telefons:</label><br>
  <input type="text" id="ftel" name="ftel">
  <span class="error">* <?php echo $ftelErr;?></span>
<br><br>
  <label for="fadress">Adrese:</label><br>
  <input type="text" id="fadress" name="fadress">
  <span class="error">* <?php echo $fadressErr;?></span>
<br><br> 
  <label for="lage">Vecums:</label><br>
  <input type="text" id="lage" name="lage">
<span class="error">* <?php echo $lageErr;?></span>
<br><br>  
  
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


        <table>
            <tr>
               <th>Vārds</th>
               <th>Uzvārds</th>
               <th>Telefons</th>
               <th>Adrese</th>
				<th>Vecums</th>
          </tr>
<?php

$sql = "select * from kontakti";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['vards'] . "</td>";
                echo "<td>" . $row['uzvards'] . "</td>";
                echo "<td>" . $row['telefons'] . "</td>";
                echo "<td>" . $row['adrese'] . "</td>";
				echo "<td>" . $row['vecums'] . "</td>";
            echo "</tr>";
        }
}}?>
</table>
    
 
 </body>
</html>