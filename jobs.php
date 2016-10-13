<?php

$to = "1buttonwenzel@gmail.com";
$to_name = "1buttonwenzel";
$from = "application@onebuttonwenzel.com";
$from_name = "OneButtonWenzel Applicant";

$subject = "OneButtonWenzel application";

if (isset($_POST['submit'])) {
    if ($_POST['text'] == "" /*&& !is_uploaded_file($_FILES['attachment']['tmp_name'])*/) {
        $status = "Please fill out the application form.<hr/>";
    }
    else {
        $body = $_POST['text'];
        
        $file = $_FILES['attachment']['tmp_name'];
        $filename = $_FILES['attachment']['name']; 
        $file_size = filesize($file);
        $handle = fopen($file, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));
        $name = basename($file);
        $header = "From: ".$from_name." <".$from.">\r\n";
        $header .= "Reply-To: ".$from."\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
        $header .= "This is a multi-part message in MIME format.\r\n";
        $header .= "--".$uid."\r\n";
        $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $header .= $body."\r\n\r\n";
        $header .= "--".$uid."\r\n";
        $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
        $header .= "Content-Transfer-Encoding: base64\r\n";
        $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
        $header .= $content."\r\n\r\n";
        $header .= "--".$uid."--";

        if (mail("$to_name<$to>", $subject, "", $header)) {
            $status = "Thanks, your application was successfully submitted.<hr/>";
        }
        else {
            $status = "Error submitting application.<hr/>";
        }
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>One Button Wenzel</title>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>


<div class="main-content">

<h3><?=$status?></h3>
<br>
<h3>We're looking for amazing people to help revolutionize the world of food ordering. We're looking for engineers and marketers. Who are you?</h3>
    <div id="default">


<form method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>">
<textarea name="text" rows="10" cols="35"></textarea><br>
<!--
<h5>Upload a resume:</h5>
<input type="file" name="attachment"><br>
-->
<input type="submit" value="Submit" name="submit">
</form>


    
</div>
</div>

</body>
</html>

