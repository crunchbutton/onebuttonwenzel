<?php

$to = "1buttonwenzel@gmail.com";
$to_name = "1buttonwenzel";

$header= "From: " . "suggestions@onebuttonwenzel.com";
$timeStr = date('Y/m/d g:i:s A');
$subject = "Suggestion for OneButtonWenzel ".$timeStr;

if (isset($_POST['submit'])) {
    if ($_POST['text'] == "") {
        $status = "Please type your comment in the text box.";
    }
    else {
        $body = $_POST['text'];

        if (mail("$to_name<$to>", $subject, $body, $header)) {
            $status = "Thanks, your feedback has been submitted!<br>";
        }
        else {
            $status = "Error submitting suggestion.<br>";
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
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-24808834-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- start Mixpanel --><script type="text/javascript">var mpq=[];mpq.push(["init","174a4ca74a34c97ec5a5390545210cf1"]);(function(){var b,a,e,d,c;b=document.createElement("script");b.type="text/javascript";b.async=true;b.src=(document.location.protocol==="https:"?"https:":"http:")+"//api.mixpanel.com/site_media/js/api/mixpanel.js";a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a);e=function(f){return function(){mpq.push([f].concat(Array.prototype.slice.call(arguments,0)))}};d=["init","track","track_links","track_forms","register","register_once","identify","name_tag","set_config"];for(c=0;c<d.length;c++){mpq[d[c]]=e(d[c])}})();
</script><!-- end Mixpanel -->
</head>


<div class="main-content" id="confused">




<br>
<center>
<span style="font-size:30px"><b>Contact Us</span><br>
<small>Include your email/phone for a fast response</small></b><br><br><center>
<?=$status?>
<form method="post" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>">
<textarea name="text" rows="7" cols="38"></textarea><br>

<input type="submit" value="Submit" name="submit">
</form></center>
<br><br>
<hr>
<span style="font-size:30px"> <b>What is a Wenzel?</b><span>
<br><span style="font-size:13px"><center>A Wenzel is the best or favorite food item(s) of a restaurant, community, or individual. Yale's top Wenzel is the Wenzel Buffalo Chicken Sandwich, sold by Alpha Delta Pizza.<br></span>
<span style="font-size:30px"> <b>What's One Button Wenzel?</b><span>
<br><span style="font-size:13px"><center>It's kind of like calling and placing an order at Alpha Delta, but faster, free, and with order and payment info saved.<br>We facilitate Wenzel delivery anywhere within range in New Haven between 2:30 PM and 3 or 4 AM. We'll be relaunching in New Haven soon with a shiny new product.<br></span>
<b>

<br><span style="font-size:15px">
<a href="intern.php">Work for Wenzels</a> <br><br>
<a href="/">Home</a></span></b>
    
</div>

</body>
</html>

