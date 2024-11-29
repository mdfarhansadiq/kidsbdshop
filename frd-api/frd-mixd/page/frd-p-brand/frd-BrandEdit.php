<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Brand Edit";//PAGE TITLE
$p="BrandAdd";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Brand Edit </h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    



<link rel="stylesheet" href="<?php echo "$a_hurl_frd"?>/inc/css/catt_viewing_frd.css">

<!-- 1 scripts s -->
<section>
<?php
///////////////////////////////////////////////////
/////////// Edit Id Reciving from get url /////////
///////////////////////////////////////////////////
if( isset($_GET['editbrand_id']) ){
    $editbrand_id=$_GET['editbrand_id'];
}    
    
    
////////////////////////////////////////////////////////// 
/////////// Updating information /////////////////////////
//////////////////////////////////////////////////////////
if(isset($_POST['update_info_sub'])){
     
     $f_brand_name_bn=$_POST['f_brand_name_bn']; 
    $f_brand_slug=$_POST['f_brand_slug'];
    
        ///  Slug name modifiying
        $f_brand_name_strtolower=strtolower("$f_brand_slug");
        $f_brand_slug_mody=preg_replace("/ /","-",$f_brand_name_strtolower);// 

        
       try{
            $FRQ = "UPDATE frd_brandss SET bn_name = :bn_name, slugg = :slugg WHERE id = $editbrand_id";
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->bindParam(':bn_name', $f_brand_name_bn, PDO::PARAM_STR);
            $FRQ->bindParam(':slugg', $f_brand_slug_mody, PDO::PARAM_STR);
            $FRQ->execute();
            FR_SWAL("BRAND UPDATE DONE","","success");
        }catch(PDOException $e){
            FR_SWAL("BRAND UPDATE FAILED","","error");
            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
        }

}
      
      
      
      
      
      

if(isset($_FILES['FRD_IMG']) AND !empty($_FILES['FRD_IMG']['name'])){
    //PR($_FILES['FRD_IMG']);
  
    //FRD VC NEED:-
        $FR_VC_IMG_EXTENTION = "";
        $FR_VC_IMG_MAX_SIZE = "";
        $FR_VC_IMG_STORE_DONE = "";
		$FR_VC_IMG_WIDTH = "";
        $FR_VC_IMG_HEIGHT = "";
		
		
    //FRD UPLODE IMG CONFIG:-
        $FRc_Img_MaxSize_KB = 50000;
        $FRc_Img_MaxSize_Dis = "30 kb";
        
        
        $FRc_Img_Name = $_FILES['FRD_IMG']['name'];
        $FRc_Img_Templocalion = $_FILES['FRD_IMG']['tmp_name'];
        $FRc_Img_Size = $_FILES['FRD_IMG']['size'];//BYTE FORMET
        $FRc_Img_Size_kbf=round($FRc_Img_Size/1000);//KB FORMET
        //+
        $FRc_Img_ExtentionExplor = explode('.',$FRc_Img_Name);
        $FRc_Img_Extention = strtolower( end($FRc_Img_ExtentionExplor) );
        //+
        $FRc_Img_WidthHeight = getimagesize($FRc_Img_Templocalion);
        $FRc_Img_Width = $FRc_Img_WidthHeight[0];    
        $FRc_Img_Height = $FRc_Img_WidthHeight[1];
        //+ 
         $FRc_Img_StoreName = "$FR_NOW_TIME-$editbrand_id"."_frd".".$FRc_Img_Extention";
         $FRc_Img_StoreLocation = "$FR_PATH_HD"."frd-data/img/brands_thum/$FRc_Img_StoreName";
  
        //img extention validator:-
        if($FRc_Img_Extention =='jpg' || $FRc_Img_Extention == 'png'){
            $FR_VC_IMG_EXTENTION = 1;
        }else{
            FR_SWAL("Hi $UsrName","You Can Upload Only JPG Or PNG Images","error");
            goto LAST_THIS_IMG;
        }
        //img size validator:-
        if($FRc_Img_Size > $FRc_Img_MaxSize_KB){
            FR_SWAL("Hi $UsrName","Maximum $FRc_Img_MaxSize_Dis image you can uplode!","error");
        }else{
            $FR_VC_IMG_MAX_SIZE = 1;
        } 
		//FRD_VC____________________ IMG WIDTH:-
        if($FRc_Img_Width == 400){
            $FR_VC_IMG_WIDTH = 1;
        }else{  
            FR_SWAL("Hi $UsrName","IMG WIDTH NEED 400 PX ($FRc_Img_Width)","error");
        }
        //FRD_VC____________________ IMG HIDTH:-
        if($FRc_Img_Height == 400){
            $FR_VC_IMG_HEIGHT = 1;
        }else{  
            FR_SWAL("Hi $UsrName","IMG HEIGHT NEED 400 PX ($FRc_Img_Height)","error");
        }
  
  
  
  
        //FRD IMAGE STORE START :--
            if($FR_VC_IMG_EXTENTION == 1 and $FR_VC_IMG_MAX_SIZE == 1 and $FR_VC_IMG_WIDTH == 1 and $FR_VC_IMG_HEIGHT == 1){
  
                //FRD IMG MOVE:-
                    if( move_uploaded_file($FRc_Img_Templocalion,$FRc_Img_StoreLocation) == 1){
                        $FR_VC_IMG_STORE_DONE = 1;
                    }else{
                      FR_SWAL("ERROR","Image Store Failed","error");
                    }
                

            }
        //END>>>
  
  
        //FRD IMAGE STORE NAME SAVE IN DB:-
           if($FR_VC_IMG_STORE_DONE == 1){
                $FRQ = "UPDATE frd_brandss SET thumb_picc='$FRc_Img_StoreName' WHERE id = $editbrand_id";
                $R = FR_DATA_UP("$FRQ");
                if($R['FRA']==1){
                    FR_SWAL("Hi $UsrName","Image Update  Done","success");
                }else{
                    FR_SWAL("Hi $UsrName","Image Update  Failed","error");
                }
           }
        //END>>
  
        LAST_THIS_IMG:
   
 }
      
      
      
      
      
////////////////////////////////////////////////////////// 
/////////// Updating Baner pic /////////////////////////
//////////////////////////////////////////////////////////
if(isset($_POST['update_baner_sub'])){
                    $f_name=$_FILES['pic1']['name'];
                    $f_tmp_localion=$_FILES['pic1']['tmp_name'];
                    $f_size=$_FILES['pic1']['size'];
                   //+
                    $pic_wdthheight=getimagesize($f_tmp_localion);
                    $pic_width=$pic_wdthheight[0];    
                    $pic_height=$pic_wdthheight[1];
                    //+
                    $f_extention_explor= explode('.',$f_name);
                    $f_extention = strtolower( end($f_extention_explor) );
                    $f_store_name =$editbrand_id.'_frd.'.$f_extention;
                    $f_store = "$FR_HDPATH/frd-data/img/brands_banar/$f_store_name";    

                   if($pic_width==1200 and $pic_height==300){ 
                    if($f_extention=='jpg'||$f_extention=='png'||$f_extention=='gif'){
                         if($f_size>=200000){
                            $alert_frd_r="Maximum 200kb Images You Can Uplode";
                        }else{
                             if( move_uploaded_file($f_tmp_localion,$f_store) ){

                                try{
                                    $FR_CONN->exec("UPDATE frd_brandss SET baner_picc = '$f_store_name'
                                    where id = $editbrand_id");
                                    FR_SWAL("Baner Image Update Done!","","success");  
                                }catch(PDOException $e){
                                    FR_SWAL("Baner Image Update Failed!","","error");  
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }

                             }
                            }
                    }else{
                        $alert_frd_r="You Can Uplode Only jpg & png & gif Images";
                    } 
                       
                   }else{
                       FR_SWAL("Image Dimension Should be 1200x300","","error");
                   }
}
      
      
    
    
    
    
    
///////////////////////////////////////////////////////////
//////////////// brand Table Data Fetching //////////
//////////////////////////////////////////////////////////  
if( isset($_GET['editbrand_id']) ){

    /////////// Catehories tabele data fetching ///////   
    $q_frd="select * from frd_brandss where id=$editbrand_id";
    require_once("$rtd_path/1_frd.php");   
    require("$rtd_path/brands_t_frd.php");
}
?>
</section>
<!-- 1 scripts e -->







   
 
   
       
<!-- Edit Section S | Edit form S-->   
<section>
 <?php if(isset($_GET['editbrand_id'])){ ?>
  <div class="container">
     
      <div class="row">
          <div class="col-md-8">
              <h4><?php echo "Brand ID: $brand_id";?></h4>
              <h4><?php echo "Brabd Name: $brand_bn_name";?></h4>  
          </div>
          <div class="col-md-4">
          </div>
      </div>
     
     
      <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">

              <form class="jumbotron" id="" action="" method="post">
                 <span>Brand Name Bangla* </span>
                 <input class="form-control" type="text"  name="f_brand_name_bn" value="<?php echo "$brand_bn_name"?>" required>
                 
                 <br>
                 <span>Slug *</span>
                 <input class="form-control" type="text"  name="f_brand_slug" value="<?php echo "$brand_slugg"?>" required>
                 
                 <br>
                 <div class="text-right">
                     <input class="btn btn-success" type="submit" name="update_info_sub" value="Confirm & Update">
                 </div>
              </form> 
             
     

            <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
            
             <div class="text-center">
                 <img  src="<?php echo "$brand_thumb_pic_path"?>" alt="" width="200px" height="200px" >
             </div>
             <br>
             <small> Image Size Should be Maximum 30 KB And Dimension 400 x 400 px And file jpg/png</small>
             <input class="form-control" type="file" name="FRD_IMG" required>

             <br>
             <div class="text-right">
                 <input class="btn btn-info" type="submit" value="Update Thumbel">  
             </div>
            </form>


             

            <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
             <img src="<?php echo "$brand_banar_pic_path"?>" alt="" class="img-responsive banerimg">

             <br>
             <small> Image Size Should be Maximum 100 KB And Dimension 1200x300 And file jpg/png</small>
             <input class="form-control" type="file" name="pic1" required>

              <br>
              <div class="text-right">
                  <input class="btn btn-primary" type="submit" name="update_baner_sub" value="Update Baner">
              </div>
             </form>
             
             
             
          </div>
          <div class="col-md-3"></div>
      </div>
  </div>
   <?php } ?>  
</section>
<!-- Edit Section e -->   






<?php require_once('frd1_footer.php'); ?>   