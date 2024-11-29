<?php
$cust_name=$_SESSION['s_cust_Name'];

FRF_CLOGOUT();

header("location:$FRD_HURL/?FRD_ALERT = প্রিয় <b class='g2'> $cust_name </b>  আপনার  লগ আউট সম্পূর্ণ হয়েছে! <br/> ধন্যবাদ আমাদের সাইট ব্যবহার করার জন্য! ভালো থাকবেন আবার আসবেন শুভকামনা রইল! ");