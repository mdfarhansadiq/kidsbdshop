<?php 
require_once('frd1_whoami.php');
$FR_ptitle="TC Tutorials";//PAGE TITLE
$p="tutorials";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Tutorials </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
$FRc_ThemeCustomizMutiProductThemVideosID = "jIhfa2_PH-w,uF_tDIk83Fk,cLL96j6hT2Y,qtVVhkfYRFA,AibxAj_AbNg,5Lkcl51waiQ,femsyhRBLrY,e4ydAu2gEmA,56xKYSxpZ-Q,kvIFGoPOz_4,85yoBUO1Og4,Py2o20eijN8,WMczMHKMzgo,TQsU_WR7wgw,ikk95fK15ZU,Xhc3csjjzx0,wQRKvnPEqFE,VQc_ssD0Gq0,h249VxoZ9Ns,QyOwsryz7mk,r0BMGQxRDxY,FIiJUvYfmzw,r-nodTFJyAc,HrwSpKqHPpI,I83KUdaZGig,JBhjcGPrW_g,leTvXVrshIs";
$FRcARR_ThemeCustomizMutiProductThemVideosID = explode(',',$FRc_ThemeCustomizMutiProductThemVideosID); 

?>   
</section>
<!-- 1 SCRIPT END -->    


<section>
    <div class="container">
    <div class="col-md-11">
      <!-- ##  -->
      <div class="row">
          <div class="col-md-12 jumbotron" id="JumpLink_hshdhdytx">
              <h2 class="boldd">আপনার ই-কমার্স ওয়েবসাইটের থিম কাস্টমাইজেশন করা শিখুন</h2>
              <ul style="list-style:none;">
               <li><a href="https://www.youtube.com/playlist?list=PL_rzCPKLsiWw0b_L49mB5T8CKfE2tGvNf" target="_blank">  🎥 YouTube Playlist <i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
              </ul>
              <hr>
              <?php 
              foreach($FRcARR_ThemeCustomizMutiProductThemVideosID AS $FR_ITEM){
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