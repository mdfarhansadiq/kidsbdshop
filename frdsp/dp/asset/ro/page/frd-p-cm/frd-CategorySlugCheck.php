<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Category Slug Check";//PAGE TITLE
$p="CategorySlugCheck";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Category SlugCheck </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    

   





<br>
<!-- ## S -->
<section>
<div class="container">
    <div class="row">
       <div class="col-md-4">
         <h4 class="TAC">
           Slug Not Support: <br>
           & <br>
           ' <br>
         </h4>
       </div>
        <div class="col-md-4 jumbotron">
            <?php 
                $q_frd="SELECT * from frd_categoriess WHERE statuss = 1 ORDER BY id ASC";
                require("$rtd_path/1_frd.php");   
                for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S 
                   require("$rtd_path/catt_t_frd.php");
                    echo "<h4><a href='cm-CategoryEdit?editcat_id=$catt_id'>#$catt_id ===> $catt_slugg  <button class='btn btn-success btn-xs'><b class='glyphicon glyphicon-edit'></b></button> </a></h4>";


                }//For Loop E
            ?>   
        </div>
        <div class="col-md-4"></div>    
    </div>
</div> 
</section>  
<!-- # E -->







<?php require_once('frd1_footer.php'); ?>   