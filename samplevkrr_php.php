<html>
<head><title>Combined Feedback Form</title></head>
<body>

<?php

$self = $_SERVER['PHP_SELF'];
$username = $_POST['username'];
$useraddr = $_POST['useraddr'];
$comments = $_POST['comments'];
$sent = $_POST['sent'];

$form ="<form action=\"$self\" method=\"post\">";
$form.="Name:<input type=\"text\" name=\"username\"";
$form.=" size=\"30\" value=\"$username\" >";
$form.="Email:<input type=\"text\" name=\"useraddr\"";
$form.=" size=\"30\" value=\"$useraddr\">";
$form.="Comments:<textarea name=\"comments\" >";
$form.="$comments</textarea><br/>";
$form.="<input type=\"submit\" name=\"sent\" value=\"Send Form\">";
$form.="</form>";

if($sent)
{
  $valid=true;

  if( !$username )
  { $errmsg.="Enter your name...<br />"; $valid = false; }

  if( !$useraddr )
  { $errmsg .="Enter your email address...<br />"; $valid = false; }

  if( !$comments )
  { $errmsg.="Enter your comments...<br />"; $valid = false; }

  $useraddr = trim($useraddr);
  $_name = "/^[-!#$%&\'*+\\.\/0-9=?A-Z^_'{|}~]+";
  $_host = "([-0-9A-Z]+\.)+";
  $_tlds = "([0-9A-Z]){2,4}$/i";
  if( !preg_match( $_name."@".$_host .$_tlds,$useraddr ) )
  { 
    $errmsg.="Email address has incorrect format!<br />";
    $valid=false;
  }
}

if($valid != true)
{
  echo( $errmsg.$form );
}
else
{
  $to = "php@h.com";

  $re = "Feedback from $username";

  $msg = $comments;

  $headers  = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html;";   
  $headers .= "charset=\"iso-8859-1\"\r\n";

  $headers .= "From: $useraddr \r\n";

  if(mail($to,$re,$msg, $headers))
  { echo("Your comments have been sent - thanks $username");}

}
?>

</body></html>