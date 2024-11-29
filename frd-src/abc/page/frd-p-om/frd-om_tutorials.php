<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Order Management Tutorials";//PAGE TITLE
$p="tutorials";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Tutorials </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
$FRc_OrdermangPanelVideosID = "qu4syAhFSJs,fQ_aXLcoZjc,zc7eoDP6Yd4,l1Skp1we43Q,nSmIstjkc9k,75X84ZGC6gA,1zJKzkB2ass,jtPl2C4TbBw,-WsY6UrDc3Y,3JkUxPSJBBE,5Ppc02S3QUI,rYHdT7nORdE,tn7c6cdsFB4,cjzvTFH6GWw,Awrt-L9Ygus,RDWaBi-ilLA,YjABP2VmaDs,_Yr5YdtYPio,ecGcouo_4SI,eb3wJ0jcqN4,gmbTDHeanCM,zcT40oWmalc,L-eo1T16Nzg,IG5KVAcYo6g,uzzN83VVfek,-JKHY2wh03k,qVVrDd-h5gE,-oYHx7z9zb8,xbJjFoNlTAk,QRlpoeSihTQ,bv9tkmYn2w8,cRi5zykETrw,ZCRR9szSelg,539t9H4iBn0,WyT1IFIxWxE,tgZWPhvuaAA,giYeXW1ik5U,meIsMEXtbNI,OwD4HCFA2Ys";
$FRcARR_OrdermangPanelVideosID = explode(',',$FRc_OrdermangPanelVideosID); 
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
            <h2 class="boldd">প্রিয় বস <?php echo "$UsrName";?> আপনার অর্ডার ম্যানেজমেন্ট করা শিখুন!</h2>
            <ul style="list-style:none;">
               <li><a href="https://www.youtube.com/watch?v=qu4syAhFSJs&list=PL_rzCPKLsiWybwr9L_HlOkw2-YAg9tELy" target="_blank">  🎥 YouTube Playlist <i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
            </ul>
            <hr>
            <?php 
             foreach($FRcARR_OrdermangPanelVideosID AS $FR_ITEM){
                echo "
                <div class='col-md-6 mb-10'>
                  <a href='https://www.youtube.com/watch?v=$FR_ITEM&list=PL_rzCPKLsiWybwr9L_HlOkw2-YAg9tELy' target='_blank'>
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