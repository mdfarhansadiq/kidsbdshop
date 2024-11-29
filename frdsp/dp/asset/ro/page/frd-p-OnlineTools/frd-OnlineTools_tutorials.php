<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Online Tools Tutorials";//PAGE TITLE
$p="tutorials";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Tutorials </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
$FRc_OnlineToolsMangVideosID = "68WBm2vlNEc,y_NxKfZmEj8,pG2s7m-aMKk,ys6dtFnO4Eo,0qqjDjPvAiQ,MkzH8j5xkFA,Sm8upiKLqgU,dD6fz5wavbk,OivYHqfxUJk,aeoHfJgiOzU";
$FRcARR_OnlineToolsMangVideosID = explode(',',$FRc_OnlineToolsMangVideosID); 
?>   
</section>
<!-- 1 SCRIPT END -->    




   
<section>
    <div class="container">
    <div class="col-md-11 mt-10">

     <!-- ##  -->
     <div class="row">
        <div class="col-md-12 jumbotron" id="JumpLink_hdhedx">
            <h2 class="boldd">অনলাইন টুলস এর ব্যবহার শিখুন আপনার ই-কমার্স ওয়েবসাইট ম্যানেজমেন্ট করার জন্য</h2>
            <ul style="list-style:none;">
               <li><a href="https://www.youtube.com/playlist?list=PL_rzCPKLsiWzsFr670wfZUYTD7mUj1KRK" target="_blank">  🎥 YouTube Playlist <i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
              </ul>
            <hr>
            <?php 
             foreach($FRcARR_OnlineToolsMangVideosID AS $FR_ITEM){
                echo "
                <div class='col-md-6 mb-10'>
                  <a href='https://youtu.be/$FR_ITEM' target='_blank'>
                    <img src='https://img.youtube.com/vi/$FR_ITEM/maxresdefault.jpg' alt='' class='img-responsive'> 
                  </a>
                </div>
                ";
             }
            ?>
        </div>
     </div>


    </div>
    </div>
</section>



<?php require_once('frd1_footer.php'); ?>