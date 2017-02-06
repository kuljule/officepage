<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = "ghost@ghost.com";//<== update the email address
$email_subject = "Ghost Revealed";
$email_body = "You have received a new message from $email_from.\n".
    "Here is the message:\n Now I have taken over your device! Beware!\n";
    
$to = "$visitor_email";
$headers = "From: $email_from" . "\r\n" . 
"Reply-To: $visitor_email";
//Send the email!
mail($to,$email_subject,$email_body,$headers, "-f ghost@localhost.com");
//done. redirect to thank-you page.
header('Location: thank-you.html');
exec("sound.bat");


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 