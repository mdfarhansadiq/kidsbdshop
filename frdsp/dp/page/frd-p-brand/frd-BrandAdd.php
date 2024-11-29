<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Add Brand";//PAGE TITLE
$p="BrandAdd";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Add Brand </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    

   

<!-- <h2 class="PT"> Add New Brands</h2> -->
<style>
    .add_fat_cat{
        display: none;
    }
</style> 

<!-- 1 scripts-->
<section>
<?php
    
/////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////    
/////////////////////////////////////////////////////////////////    
if(isset($_POST['add_new_brand_sub'])){
$f_brand_name_bn=$_POST['f_brand_name_bn'];
$f_brand_slug=$_POST['f_brand_slug'];

if($f_brand_slug==""){
    $f_slug_name_strtolower=strtolower("$f_brand_name_bn");
    $f_slug_name_mody=preg_replace("/ /","-",$f_slug_name_strtolower);//   
}else{
    $f_slug_name_strtolower=strtolower("$f_brand_slug");
    $f_slug_name_mody=preg_replace("/ /","-",$f_slug_name_strtolower);//
}
           //Insert Data S 
                    $arr = [];
                    $arr['bn_name'] = $f_brand_name_bn;
                    $arr['slugg'] = $f_slug_name_mody;
                    $arr['statuss'] = 1;
                    $arr['byy'] = $UsrId;
                    $arr['datee'] = $FR_NOW_DATE;
                    $arr['timee'] = $FR_NOW_TIME;
                    $FRR = FR_DATA_IN("frd_brandss",$arr);
                    if($FRR['FRA']==1){
                        $last_insert_id = $FRR['FR_LIID'];
                        FR_SWAL("New Brand Add Done","$f_brand_name_bn","success");
                    }else{
                        FR_SWAL("New Brand Add Failed","","error");
                    }
            //Insert Data E 
   
}    
?>    
</section>  
  
  
       
<br>
<div class="section">
    <div class="container">
    <div class="col-md-11">


        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 jumbotron">
                 <form id="" action="" method="post">
                     <input class="form-control" type="text"  name="f_brand_name_bn" placeholder="Input Brand Name" required >
                     <br>
                     <input class="form-control" type="text"  name="f_brand_slug" placeholder="Input Slug name" >
  
                     <br>
                     <div class="text-right">
                         <input class="btn btn-success" type="submit" name="add_new_brand_sub" value="Confirm & add">
                     </div>
                </form> 
            </div>
            <div class="col-md-4"></div>
        </div>


        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <table class="t1 table table-bordered">
                    <tr class="TH">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Slug</td>
                        <td class="TAR">Action</td>
                    </tr>
                <?php
                    $q_frd="SELECT * from frd_brandss ORDER BY id DESC";
                    require_once("$rtd_path/1_frd.php"); 
                    for($i=1;$i<=$rowsnum_frd;$i++){//For Loop S
                    require("$rtd_path/brands_t_frd.php"); 
                    echo "
                        <tr>
                        <td>$brand_id</td>
                        <td>$brand_bn_name</td>
                        <td>$brand_slugg</td>
                        <td class='TAR'>  <a href='$FR_THISHURL/brand-BrandEdit?editbrand_id=$brand_id'> <span class='glyphicon glyphicon-edit btn btn-success'></span> </a> </td> 
                        </tr>
                        ";
                    }//For Loop E  
                    ?>
                </table>    
                
            </div>
            <div class="col-md-4"></div>    
        </div> 

    </div>
    </div>
</div>










<?php require_once('frd1_footer.php'); ?>   