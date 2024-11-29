<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Software Users List";//PAGE TITLE
$p="SoftUsrList";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> VIEW USERS </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 
   
?>   
</section>
<!-- 1 SCRIPT END -->    

   

<section>
 <div class="container">
  <div class="col-md-11">


    <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6">
            <?php 
             $q_frd="SELECT * from frd_usr where typee !='cu' AND statuss IN(1,2) ORDER BY id DESC LIMIT 0,300"; 
             require_once("$rtd_path/1_frd.php"); 
             for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S
             require("$rtd_path/usr_t_frd.php"); 
             ?>
                
             <?php 
              echo "
                   <table class='table table-bordered frd-card-1'>
                     <tr>
                          <td width='10%' class='text-center'>
                            <img src='$usr_pic_path' alt='#' height='150px' width='150px' >
                          <br>
                          <a href='usr-EditSoftUser?editid=$usr_id' class='fr-text-deco-none'><button class='btn btn-danger btn-xs btn-block'><span class='glyphicon glyphicon-edit'></span>EDIT USER</button></a>
                          </td>
             
                         <td width=''>
                           $usr_namee [#$usr_id] <br>
                           $usr_status_mody <br>
                           $usr_genderr_mody <br>
                           $usr_type_mody <br>
                           ".date('d-M-Y h:i a',$usr_time)."
                         </td>
                      </tr>
                   </table> 
                   ";
             ?>  
             
             <?php        
             }//For Loop E
            ?>
         </div>
         <div class="col-md-3"></div> 
     </div>

  </div>
 </div>  
</section>








<?php require_once('frd1_footer.php'); ?>   