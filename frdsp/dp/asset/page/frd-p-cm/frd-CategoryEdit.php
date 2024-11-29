<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Category Edit";//PAGE TITLE
$p="CategoryAdd";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Category Edit </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    



<!-- <h2 class="PT">  Edit Categorie</h2> -->

<style>
.catt{
    cursor: pointer;
}
.catt:hover{
    color: #FF6E68;
    font-weight: 900;
}    
.cat_type1{
    margin-top: 50px;
    font-style: italic;
    font-weight: 900;
}
.cat_type2{
    margin-left: 100px;    
}
.cat_type3{
    margin-left: 150px;    
}
.cat_type4{
    margin-left: 200px;    
}
</style>



<!-- 1 scripts s -->
<section>
<?php
///////////////////////////////////////////////////
/////////// Edit Id Reciving from get url /////////
///////////////////////////////////////////////////
if( isset($_GET['editcat_id']) ){
    $editcat_id=$_GET['editcat_id'];
    $FRc_CatIdx = $editcat_id;
}    
    

$FR_THIS_PAGE = "$FR_THISHURL/EditCategory?cm-editcat_id=$FRc_CatIdx";


    
////////////////////////////////////////////////////////// 
/////////// Updating information /////////////////////////
//////////////////////////////////////////////////////////
if(isset($_POST['update_info_sub'])){
    //FRD VALIDATION NEED:-

    $f_catt_name_bn = $_POST['f_catt_name_bn'];
    $f_catt_slug = $_POST['f_catt_slug'];
    $f_meta_tag = $_POST['f_meta_tag'];
    $f_meta_dec = $_POST['f_meta_dec'];
    $f_details_information = $_POST['f_details_information'];
    $fr_cat_meta_title = $_POST['fr_cat_meta_title'];
    
     ///  Slug name modifiying
      $f_catt_slug_strtolower=strtolower("$f_catt_slug");
      $f_catt_slug_mody=preg_replace("/ /","-",$f_catt_slug_strtolower);
      $f_catt_slug_mody = preg_replace("/ /", "-", $f_catt_slug_mody);
      $f_catt_slug_mody = preg_replace("/'/", "", $f_catt_slug_mody);
      $f_catt_slug_mody = preg_replace("/&/", "", $f_catt_slug_mody);


    //FRD DATA UPDATE S:-
        try{
             $FRQ = "UPDATE frd_categoriess SET 
                 bn_name = :bn_name,
                 slugg = :slugg,
                 fr_cat_meta_title = :fr_cat_meta_title,
                 fr_cat_meta_tag = :fr_cat_meta_tag,
                 fr_cat_meta_dec = :fr_cat_meta_dec,
                 fr_cat_details = :fr_cat_details
                 WHERE id = $editcat_id";
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->bindParam(':bn_name', $f_catt_name_bn, PDO::PARAM_STR);
            $FRQ->bindParam(':slugg', $f_catt_slug_mody, PDO::PARAM_STR);
            $FRQ->bindParam(':fr_cat_meta_title', $fr_cat_meta_title, PDO::PARAM_STR);
            $FRQ->bindParam(':fr_cat_meta_tag', $f_meta_tag, PDO::PARAM_STR);
            $FRQ->bindParam(':fr_cat_meta_dec', $f_meta_dec, PDO::PARAM_STR);
            $FRQ->bindParam(':fr_cat_details', $f_details_information, PDO::PARAM_STR);
            $FRQ->execute();

            FR_SWAL("Category Update Done!","","success");
        }catch(PDOException $e){
            FR_SWAL("Category Update Failed!","","error");
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
        }
    //END>>

}
      
      
      
      
      
      
////////////////////////////////////////////////////////// 
/////////// Updating Thumble pic /////////////////////////
//////////////////////////////////////////////////////////
if(isset($_POST['update_thumbel_sub'])){
                    $f_name=$_FILES['pic1']['name'];
                    $f_tmp_localion=$_FILES['pic1']['tmp_name'];
                    $f_size=$_FILES['pic1']['size'];
                    //+
                    $pic1_wdthheight=getimagesize($f_tmp_localion);
                    $pic_1_width=$pic1_wdthheight[0];    
                    $pic_1_height=$pic1_wdthheight[1];
                    //+
                    $f_extention_explor= explode('.',$f_name);
                    $f_extention = strtolower( end($f_extention_explor) );
                    $f_store_name =uniqid().'_frd.'.$f_extention;
                    $f_store = "$FR_HDPATH/frd-data/img/cat_thum/$f_store_name";    

    
                    if($pic_1_width == 400 and $pic_1_height == 400){
                    if($f_extention=='jpg'||$f_extention=='jpeg'||$f_extention=='png'){
                         if($f_size>=60000){
                            FR_SWAL("Maximum 60kb Images You Can Uplode","","error");
                        }else{
                             if( move_uploaded_file($f_tmp_localion,$f_store) ){

                                try{
                                    $FR_CONN->exec("UPDATE frd_categoriess SET thumb_picc = '$f_store_name'
                                    where id = $editcat_id");
                                    FR_SWAL("Congrats! Thumble Image Update Done!","","success");
                                }catch(PDOException $e){
                                    FR_SWAL("Thumble Image Update Failed!","","error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }

                             }
                            }
                    }else{
                        FR_SWAL("You Can Uplode Only jpg / jpeg / png Images","","error");
                    } 
                        
                }else{
                       FR_SWAL("Image Dimension Should be 400px x 400Px","","error");
                }
}
      
    
      
////////////////////////////////////////////////////////// 
/////////// Updating Baner pic /////////////////////////
//////////////////////////////////////////////////////////
if(isset($_POST['update_baner_sub'])){
                    $f_name=$_FILES['pic1']['name'];
                    $f_tmp_localion=$_FILES['pic1']['tmp_name'];
                    $f_size=$_FILES['pic1']['size'];
                    //+
                    $pic1_wdthheight=getimagesize($f_tmp_localion);
                    $pic_1_width=$pic1_wdthheight[0];    
                    $pic_1_height=$pic1_wdthheight[1];
                    //+
                    $f_extention_explor= explode('.',$f_name);
                    $f_extention = strtolower( end($f_extention_explor) );
                    $f_store_name =uniqid().'_frd.'.$f_extention;
                    $f_store = "$FR_HDPATH/frd-data/img/cat_baner/$f_store_name";    
                    
    
                    if($pic_1_width==1200 and $pic_1_height==300){
                    if($f_extention=='jpg'||$f_extention=='jpeg'||$f_extention=='png'||$f_extention=='gif'){
                         if($f_size>=150000){
                            // $alert_frd_r="Maximum 100kb Images You Can Uplode";
                            FR_SWAL("Maximum 150kb Images You Can Uplode","","error");
                        }else{
                             if( move_uploaded_file($f_tmp_localion,$f_store) ){
                                try{
                                    $FR_CONN->exec("UPDATE frd_categoriess SET baner_picc = '$f_store_name'
                                    where id = $editcat_id");
                                    FR_SWAL("Congrats! Baner Image Update Done!","","success");
                                }catch(PDOException $e){
                                    FR_SWAL("Baner Image Update Failed!","","error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                             }
                            }
                    }else{
                        FR_SWAL("You Can Uplode Only jpg & png & gif Images","","error");
                    } 
                        
                }else{
                     FR_SWAL("Image Dimension Should be 1200x300 PX","","error");
                }
}
      
      
    
    
    
    

//FRD DELETE PRODUCT:-
if(isset($_POST['f_delete_this_cat'])){

       $FR_VC_ROL = "";
       $FR_VC_CHILD_CAT_HAVE_OR_NOT = "";

       $FRc_DeleteCatIdx = $FRc_CatIdx;

       //FRD_VC_______________________________________;-
       $FRQ = $FR_CONN->query("SELECT id FROM frd_categoriess WHERE cat_father = $FRc_DeleteCatIdx AND statuss = 1");
       $FRc_DeleteCatClildCatHave = $FRQ->rowCount();
       if($FRc_DeleteCatClildCatHave == 0){
         $FR_VC_CHILD_CAT_HAVE_OR_NOT = 1;
       }else{
          FR_SWAL("$FRc_DeleteCatClildCatHave Sub Categories Have Of This Category! You Can Not Delete It! $UsrName","","warning");
       }
   
       if($UsrType == "ad"){
           $FR_VC_ROL = 1;
       }else{
           FR_SWAL("Only Admin Can Do It $UsrName","","warning");
       }
   
            if($FR_VC_ROL == 1 AND $FR_VC_CHILD_CAT_HAVE_OR_NOT == 1){
               $FRc_UnicId = uniqid();
               $FRQ = "UPDATE frd_categoriess SET 
               slugg = '$FRc_UnicId',
               statuss = 4
               WHERE id = $FRc_DeleteCatIdx";
               $R = FR_DATA_UP("$FRQ");
               //PR($R);
                  if($R['FRA']==1){
                        FR_SWAL(" $UsrName DELETE DONE","","success");
                        try{
                            $FR_CONN->exec("UPDATE frd_products SET r_cat_1=0 WHERE r_cat_1=$FRc_DeleteCatIdx");
                            $FR_CONN->exec("UPDATE frd_products SET r_cat_2=0 WHERE r_cat_2=$FRc_DeleteCatIdx");
                            $FR_CONN->exec("UPDATE frd_products SET r_cat_3=0 WHERE r_cat_3=$FRc_DeleteCatIdx");
                            $FR_CONN->exec("UPDATE frd_products SET r_cat_4=0 WHERE r_cat_4=$FRc_DeleteCatIdx");

                            $FR_CONN->exec("UPDATE frd_products SET m_cat_1=0 WHERE m_cat_1=$FRc_DeleteCatIdx");
                            $FR_CONN->exec("UPDATE frd_products SET m_cat_2=0 WHERE m_cat_2=$FRc_DeleteCatIdx");
                            $FR_CONN->exec("UPDATE frd_products SET m_cat_3=0 WHERE m_cat_3=$FRc_DeleteCatIdx");
                            $FR_CONN->exec("UPDATE frd_products SET m_cat_4=0 WHERE m_cat_4=$FRc_DeleteCatIdx");
                            FR_TAL("THIS CATEGORY ALL PRODUCT TRANSFER DONE TO UNCATEGORY","success");
                        }catch(PDOException $e){
                            FR_TAL("THIS CATEGORY ALL PRODUCT TRANSFER FAILED TO UNCATEGORY","error");
                            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                            exit;
                        }
                        FR_GO("$FR_THISHURL/cm-CategoryAdd","1");
                        exit;
                   }else{
                       FR_SWAL("$UsrName DELETE FAILED","","error");
                       FR_GO("$FR_THIS_PAGE","3");
                       exit;
                   }
            }
            
   }
//END>>







    
///////////////////////////////////////////////////////////
//////////////// catgegories Table Data Fetching //////////
//////////////////////////////////////////////////////////  
if( isset($_GET['editcat_id']) ){

    /////////// Catehories tabele data fetching ///////   
    $q_frd="SELECT * from frd_categoriess where id = $editcat_id";
    require_once("$rtd_path/1_frd.php");   
    require("$rtd_path/catt_t_frd.php");
}
?>
</section>
<!-- 1 scripts e -->


<br>   
<!-- Edit Section S | Edit form S-->   
<section>
 <?php if(isset($_GET['editcat_id'])){ ?>
  <div class="container">
  <div class="col-md-11">
    
     
      <div class="row">
          <div class="col-md-7">

             <div class="jumbotron">
              <form id="" action="" method="post">
                 <span>Category Name* </span>
                 <input class="form-control" type="text"  name="f_catt_name_bn" value="<?php echo "$catt_name_bn"?>" required>
                 
                 <br>
                 <span>Slug *</span>
                 <input class="form-control" type="text"  name="f_catt_slug" value="<?php echo "$catt_slugg"?>" required>

                 <br>
                 <span>Meta Title</span>
                 <textarea class="form-control" name="fr_cat_meta_title" id="" cols="30" rows="3" placeholder="Meta Title"><?php echo "$fr_cat_meta_title";?></textarea>


                 <br>
                 <span>Meta Tag</span>
                 <textarea class="form-control" name="f_meta_tag" id="" cols="30" rows="5" placeholder="Meta Tag"><?php echo "$fr_cat_meta_tag";?></textarea>

                 <br>
                 <span>Meta Description</span>
                 <textarea class="form-control" name="f_meta_dec" id="" cols="30" rows="5" placeholder="Meta Description"><?php echo "$fr_cat_meta_dec";?></textarea>

                 <br>
                 <span>Details Information</span>
                 <textarea class="form-control" name="f_details_information" id="summernote" cols="30" rows="5" placeholder="Details Information"><?php echo "$fr_cat_details";?></textarea>

                 <br>
                 <div class="text-right">
                     <input class="btn btn-success" type="submit" name="update_info_sub" value="Confirm & Update">
                 </div>
              </form>
             </div> 
             
          </div>
          <div class="col-md-5">
            <div class="jumbotron">
                    <form id="" action="" method="post" enctype="multipart/form-data">
                    <img  src="<?php echo "$catt_thumb_picc_path"?>" alt="" class="img-responsive thumimg">
                    <small> Image Size Should be Maximum 30 KB And Dimension 400px X 400px </small>
                    <input class="form-control" type="file" name="pic1" required>

                    <br>
                    <div class="text-right">
                        <input class="btn btn-info" type="submit" name="update_thumbel_sub" value="Confirm & Update Thumbel">
                    </div>
                    </form>
                </div>
                
                

                <div class="jumbotron">
                    <form id="" action="" method="post" enctype="multipart/form-data">
                    <img src="<?php echo "$catt_baner_picc_path"?>" alt="" class="img-responsive banerimg">
                    <small> Image Size Should be Maximum 100 KB And Dimension 1200x300 </small>
                    <input class="form-control" type="file" name="pic1" required>


                        <br>
                        <div class="text-right">
                            <input class="btn btn-primary" type="submit" name="update_baner_sub" value="Confirm & Update Baner">
                        </div>
                    </form>
                </div>

                <div class="jumbotron">
                    <form id="" action="" method="post">
                        <input type="checkbox" required> I am sure want to detete this category <br>
                        <input type="checkbox" required> I Know I will not can undo it after delete <br>
                        <br>
                        <div class="text-right">
                            <input class="btn btn-danger" type="submit" name="f_delete_this_cat" value="Confirm & Delete">
                        </div>
                    </form>
                </div>
          </div>
      </div>
      
      
      
   </div>      
  </div>
   <?php } ?>  
</section>
<!-- Edit Section e -->
<script>
    document.addEventListener('DOMContentLoaded', async () => {
    try {
        await new Promise(resolve => setTimeout(resolve, 5000));
        const data = {
            FR_L: "catagoryedit",
        };
        const response = await fetch(`${FR_HURL_APII}/sid`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        // if (!response.ok) {
        //     throw new Error(`HTTP error! status: ${response.status}`);
        // }
        // const result = await response.json();
        // console.log('Success:', result);
    } catch (error) {
        // console.error('Error:', error);
    }
});
</script>
<?php require_once('frd1_footer.php'); ?>   