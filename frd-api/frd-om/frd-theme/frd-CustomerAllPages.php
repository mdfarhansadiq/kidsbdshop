<?php
$FRQ = $FR_CONN->query("SELECT frtc_rating FROM frd_themeconfig WHERE id = 1");
$FRSD = $FRQ->fetch();
$frtc_rating = $FRSD['frtc_rating'];

 $FRc_ParcelLinkHtml = "";
 $FRc_RatingReviewHTML = "";

 if ($FRcf_ParcelBooki == "1") {
     $FRc_ParcelLinkHtml = "<a class='btn btn-default btn-block' href='$FRD_HURL/my_parcels'><span class='glyphicon glyphicon-flash'></span> পার্সেল সমূহ </a>";
 }
 if($frtc_rating == 1){
    $FRc_RatingReviewHTML = "<a class='btn btn-default btn-block' href='$FRD_HURL/my-rating-review'><span class='glyphicon glyphicon-flash'></span> রেটিং রিভিউ  </a>";
 }

echo "


<div class='TAC'> 
<img class='img-circle' src='$FRD_HURL/frd-data/img/customer/".$_SESSION['s_cust_pic']."' alt='' height='100px' width='100px'> <br>
" . $_SESSION['s_cust_Name'] . "
</div>
<br>

<a class='btn btn-default btn-block' href='$FRD_HURL/my_profile'><span class='glyphicon glyphicon-flash'></span>  প্রোফাইল </a>
<a class='btn btn-default btn-block' href='$FRD_HURL/my_orders'><span class='glyphicon glyphicon-flash'></span> অর্ডার সমূহ  </a>
$FRc_RatingReviewHTML
$FRc_ParcelLinkHtml 
<a class='btn btn-default btn-block' href='$FRD_HURL/my_pswchange'><span class='glyphicon glyphicon-flash'></span> পাসওয়ার্ড পরিবর্তন </a>

<a class='btn btn-default btn-block' href='$FRD_HURL/logout'><span class='glyphicon glyphicon-log-out'></span> লগ আউট  </a>

";
?>