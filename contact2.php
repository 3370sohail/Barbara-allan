
<html>
<head>
<title>contact</title>
<link href="styles.css" type="text/css" rel="stylesheet">
<script type="text/javascript"> 
function EnableSend() {
        document.getElementById("submit").disabled = false;
}
</script "> 
</head>
<body>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $commentErr = $subjectErr = "";
$name = $email = $comment = $subject = $robotest = "";
$error = false ;

	if (empty($_POST["subject"])) {
     $subjectErr = "subject is required";
	 $error = true;
   } else {
     $subject = test_input($_POST["subject"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$subject)) {
       $subjectErr = "Only letters and white space allowed"; 
	   $error = true;
     }
   }
   
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
	 $error = true;
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
	   $error = true;
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
	 $error = true;
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
	   $error = true;
     }
   }
     
  

   if (empty($_POST["comment"])) {
     $commentErr = "message is required";
	 $error = true;
   } else {
     $comment = test_input($_POST["comment"]);
   }
   // robots will input this  and the error will stop them 
    $robotest = $_POST['robotest'];
	if ( $robotest != ""){
	 $error = true;
	 echo"you are a robot";
	 header("https://www.youtube.com/watch?v=S_oMD6-6q5Y");
	exit();
	}
	if ($success == "1"){
	$success = "thank you";
	}
  

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<fieldset class="border">
<legend>Message Me:</legend>
	<p><span class="error">* required field.</span></p>
	subject:  <input type="text" name="subject"  /> 
	<span class="error">* <?php echo $subjectErr;?></span>
	<br><br>
   Name: <input type="text" name="name">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   E-mail: <input type="text" name="email">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   
   <label>message:</label> <textarea name="comment" rows="5" cols="40"></textarea>
   <span class="error">* <?php echo $commentErr;?></span>
   <br><br>
   <div class="robotic">
   
      <label>If you're human leave this blank:</label>
      <input name="robotest" type="text" id="robotest" class="robotest" />
    </div>
   
   <input type="submit" name="submit" value="Submit"><span > <?php echo $success;?></span> 
   </fieldset>
</form>
<?php
$success ="";
$message = "from:".$name."                                                                                                                        ;                                                                                                                                                                                                                                                                                           ".$comment;
$headers = 'From:  '.$email . "\r\n" .
    'Reply-To:  '.$email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$to = "3370sohail@gmail.com";
if($error == false){
$success = "1";
mail($to, $subject, $message, $headers);
}

?>

</body>