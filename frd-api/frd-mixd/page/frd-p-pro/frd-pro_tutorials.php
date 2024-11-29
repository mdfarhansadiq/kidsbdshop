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

$FRc_ProMangVideosID = "nps4dpGrRuE,iJ3CYOaKGqE,YzJcyxBnrYo,iNh1nYsjjzI,WlU9A9PtSzM,y0XTFb5LGyY,lClcsIPPTCQ,twAZFbksug8,NWwiWeM_rDE,zKCTmXMrNe4,uQ6H-3hu2eA,0oyvqL8iVE4,JmvQp0Tuk1g,d5UNohnB75I,fRe0B7LOem8,WYzVWhxgbhg,uz6sDZKekso,vHjdsPiBu_Q,r2hBZ1eqzGw,e6IQB2kOB8M,SnFDgbzNIwk,wex0YpTXRVU,vJiSStmBvXI,NnEkfGQtTLk,Uy_D_6IwYTc,xb2cGMeCy9I,gS7iPNw4ODE,MU7u2kR-qK8,ojvaAkcjJOw,eVFdKYTpCu0,gjt4_Jvzrfw,DpRRKiCj6hE,2i6BToN1n6M";
$FRcARR_ProMangVideosID = explode(',',$FRc_ProMangVideosID); 

?>   
</section>
<!-- 1 SCRIPT END -->    




   



<br>
<section>
    <div class="container">
    <div class="col-md-11">


     <!-- ##  -->
     <div class="row">
        <div class="col-md-12 jumbotron" id="JumpLink_jshsyx">
            <h2 class="boldd">আপনার প্রোডাক্ট ম্যানেজমেন্ট করা শিখুন</h2>
            <ul style="list-style:none;">
               <li><a href="https://www.youtube.com/playlist?list=PL_rzCPKLsiWyyGiUsqzfxIiC35_PKrTVC" target="_blank">  🎥 YouTube Playlist <i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
              </ul>
            <hr>
            <?php 
             foreach($FRcARR_ProMangVideosID AS $FR_ITEM){
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

<style>
  html{
    scroll-behavior: smooth !important;
  }
</style>