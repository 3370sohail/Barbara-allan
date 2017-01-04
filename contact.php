
<html>
<head>
<title>contact</title>
<link href="styles.css" type="text/css" rel="stylesheet">

</head>
<body>
<?php
// define variables and set to empty values
$nameErr = $emailErr = $commentErr = $subjectErr = "";
$name = $email = $comment = $subject = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["subject"])) {
     $subjectErr = "subject is required";
   } else {
     $subject = test_input($_POST["subject"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$subject)) {
       $subjectErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
     
  

   if (empty($_POST["comment"])) {
     $commentErr = "message is required";
   } else {
     $comment = test_input($_POST["comment"]);
   }

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
   
   message: <textarea name="comment" rows="5" cols="40"></textarea>
   <span class="error">* <?php echo $commentErr;?></span>
   <br><br>
   
   <input id="submit" type="submit" name="submit" value="Submit" disabled="disabled"> 
   
   </fieldset>
</form>
<?php

$message = "from:".$name."                                                                                                                         ".$comment.";                                                                                                                                                                                                                                                                                           ".$comment;
$headers = 'From:  '.$email . "\r\n" .
    'Reply-To:  '.$email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$to = "3370sohail@gmail.com";
if($nameErr == "" && $emailErr =="" && $commentErr =="" && $subjectErr == ""){

mail($to, $subject, $message, $headers);
}

?>

</body>