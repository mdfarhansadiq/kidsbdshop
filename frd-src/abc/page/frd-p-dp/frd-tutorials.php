<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Tutorials";//PAGE TITLE
$p="tutorials";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Tutorials </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

$FRc_DefControlPanelMangVideosID = "gAfHLzNz77U,cOq5dwurnVw,woyc4I7n-QU,Wh4nwst9usI,lxoGkSjkjfU,KBdz8WsTMzI,PKChlDulBIo,eQE8VpvtgcA,SQmG2yNXRkQ,sifkoOA9kT4,GWojSY9ATzI";
$FRcARR_DefControlPanelMangVideosID = explode(',',$FRc_DefControlPanelMangVideosID); 


$FRc_MixedTopicMangVideosID = "3y06SNqHlkc,vy91KhLkJxc,2xV7xVHvB0s,DCNvzUh8S9Y,ejEgRntgoh8,P8od1ASZ0Jc,ZMqz9GNQO9M";
$FRcARR_MixedTopicMangVideosID = explode(',',$FRc_MixedTopicMangVideosID);

?>   
</section>
<!-- 1 SCRIPT END -->    




   



<br>
<section>
    <div class="container">
    <div class="col-md-11">


     <!-- ##  -->
     <div class="row">
        <div class="col-md-12 jumbotron" id="JumpLink_hsjshdhydx">
            <h2 class="boldd">আপনার ডিফল্ট কন্ট্রোল প্যানেল ম্যানেজমেন্ট করা  শিখুন</h2>
            <ul style="list-style:none;">
               <li><a href="https://www.youtube.com/playlist?list=PL_rzCPKLsiWwmiKZ2G_O6EMldO1OmrD0x" target="_blank">  🎥 YouTube Playlist <i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
            </ul>
            <hr>
            <?php 
             foreach($FRcARR_DefControlPanelMangVideosID AS $FR_ITEM){
                echo "
                <div class='col-md-6 mb-10'>
                  <a href='https://www.youtube.com/watch?v=$FR_ITEM&list=PL_rzCPKLsiWwmiKZ2G_O6EMldO1OmrD0x' target='_blank'>
                    <img src='https://img.youtube.com/vi/$FR_ITEM/maxresdefault.jpg' alt='' class='img-responsive'> 
                  </a>
                </div>
                ";
             }
            ?>
        </div>
     </div>




     <!-- ##  -->
     <div class="row">
        <div class="col-md-12 jumbotron" id="JumpLink_bhshdx">
            <h2 class="boldd"> আপনার ই-কমার্স ব্যবসা পরিচালনা করার জন্য আরও কিছু বিষয় শিখুন </h2>
            <ul style="list-style:none;">
               <li><a href="https://www.youtube.com/playlist?list=PL_rzCPKLsiWx_6gaRrnVO0WqRliQIEp2j" target="_blank">  🎥 YouTube Playlist <i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
              </ul>
            <hr>
            <?php 
             foreach($FRcARR_MixedTopicMangVideosID AS $FR_ITEM){
                echo "
                <div class='col-md-6 mb-10'>
                  <a href='https://www.youtube.com/watch?v=$FR_ITEM&list=PL_rzCPKLsiWx_6gaRrnVO0WqRliQIEp2j' target='_blank'>
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

<style>
  html{
    scroll-behavior: smooth !important;
  }
</style>