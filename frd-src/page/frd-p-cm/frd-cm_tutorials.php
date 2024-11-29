<?php 
require_once('frd1_whoami.php');
$FR_ptitle="CM Tutorials";//PAGE TITLE
$p="tutorials";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Tutorials </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

$FRc_CategoryMangVideosID = "X8aQrgv8Ttw,z9j6SVk_l50,R3EBgZoIlZY,uTX3vZrBXPc,Kra7opGLNj4,iHYH9Dfaf-k,gdysxNFIYXw,ctRcfSGUGeM,bCil212mMUs,6TITVqibdM4,YGnrWJxTrjk,kMm61fmiEGo,XTHMKHzhV7o";
$FRcARR_CategoryMangVideosID = explode(',',$FRc_CategoryMangVideosID); 
?>   
</section>
<!-- 1 SCRIPT END -->    


<section>
    <div class="container mt-5">
    <div class="col-md-11">

     <!-- ##  -->
     <div class="row">
        <div class="col-md-12 jumbotron" id="JumpLink_hjeuex">
            <h2 class="boldd">আপনার পণ্যের ক্যাটাগরি ম্যানেজমেন্ট করা শিখুন</h2>
            <ul style="list-style:none;">
               <li><a href="https://www.youtube.com/playlist?list=PL_rzCPKLsiWzlSw354vAceZ5o_5xQIww8" target="_blank">  🎥 YouTube Playlist <i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
              </ul>
            <hr>
            <?php 
             foreach($FRcARR_CategoryMangVideosID AS $FR_ITEM){
                echo "
                <div class='col-md-6 mb-10'>
                  <a href='https://www.youtube.com/watch?v=$FR_ITEM&list=PL_rzCPKLsiWzlSw354vAceZ5o_5xQIww8' target='_blank'>
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