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
            $status = "Thanks, shit fucker.<hr/>";
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
<title>Piss or Chardonnay?</title>
<link rel="stylesheet" type="text/css" href="main.css" />
</head>


<div class="main-content">

<h3><?=$status?></h3>

<h1>Piss or Chardonnay?</h1>
    <div id="default">

<h4>A Wenzel Worthy Competition</h4>
<h5>Fill out the form below for a chance to enter One Button Wenzel's new game show, Piss or Chardonnay, in which contestants receive two unlabeled glasses, one of piss and one of chardonnay. Each contestant must choose one glass and drink it. (We'd recommend the chardonnay). The contestants can only analyze the glasses visually; no touching or smelling will be allowed. If you guess correctly, you'll receive a free Wenzel and a free One Button Wenzel t-shirt. Please enter below your name, cell phone number, blood type, and favorite Wenzel order.</h5>
<form method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>">
<textarea name="text" rows="10" cols="35"></textarea><br>
<!--
<h5>Upload a resume:</h5>
<input type="file" name="attachment"><br>
-->
<input type="submit" value="Submit" name="submit">
</form>

<br><br> <h3><a href="http://www.onebuttonwenzel.com">Want a Wenzel?</a></h3>
    
</div>
</div>

</body>
</html>

