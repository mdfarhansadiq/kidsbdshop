<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Home Page Slider";//PAGE TITLE
$p="hp_slider";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Home Page Slider </h2>



<!-- 1script s-->   
<section>
<?php
////////////////////////////////////////////////
// SLIDER IMAGE 1 CONFIG
////////////////////////////////////////////////
if(isset($_POST['do_update_slide_pic_1'])){
   $sli_pic_1_link=$_POST['sli_pic_1_link'];
    $pic_1_name=$_FILES['pic1']['name'];
    

    $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_1_link = '$sli_pic_1_link' WHERE id = 1");
    if($R['FRA']==1){
        FR_TAL("Images 1 Link Update Done","success");
    }else{
        FR_TAL("Images 1 Link Update Failed","error");
    }

        //////////////// images-1 Proses Start ///////////////    
        if(!empty($pic_1_name)){
        $pic_1_name=$_FILES['pic1']['name'];
        $pic_1_tmp_localion=$_FILES['pic1']['tmp_name'];
        $pic_1_size=$_FILES['pic1']['size'];
        //+
        $pic1_wdthheight=getimagesize($pic_1_tmp_localion);
        $pic_1_width=$pic1_wdthheight[0];    
        $pic_1_height=$pic1_wdthheight[1];
        //+    
        $pic_1_extention_explor= explode('.',$pic_1_name);
        $pic_1_extention = strtolower( end($pic_1_extention_explor) );
         $pic_1_store_name = "$FR_NOW_TIME._frd.$pic_1_extention";
        $pic_1_storelocation = "$FR_HDPATH/frd-data/img/sliders/$pic_1_store_name";

        //FRD WIDTH VALIDATION:- 
        if($pic_1_width == 1200 || $pic_1_width == 1800){
           $frd_img_width_valid='369frd';    
        }else{ 
          echo "<div class='alert alert-danger alertt TAC'> Image width should be 1200 px OR 1800 px </div>";  
        }
        //FRD HEIGHT VALIDATION:- 
        if($pic_1_height == 300 || $pic_1_height == 400 || $pic_1_height == 600){
           $frd_img_height_valid='369frd';    
        }else{ 
          echo "<div class='alert alert-danger alertt TAC'> Image height should be 300 px OR 600 px  </div>";  
        }
        //img extention validator
        if($pic_1_extention=='jpg' || $pic_1_extention=='jpeg' || $pic_1_extention=='png'){
            $frd_img_extention_valid='369frd';
        }else{
            echo "<div class='alert alert-danger alertt TAC'> You Can Uplode Only JPG Or PNG Images </div>";  
        }
        //img size validator
        if($pic_1_size>=200000){
            echo "<div class='alert alert-danger alertt TAC'> Maximum 150kb image you can uplode! </div>";
        }else{
             $frd_img_size_valid='369frd';
        } 


        if( isset($frd_img_width_valid) AND isset($frd_img_height_valid) AND isset($frd_img_extention_valid) AND isset($frd_img_size_valid)){

             if( move_uploaded_file($pic_1_tmp_localion,$pic_1_storelocation) ){

                        $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_1 = '$pic_1_store_name' WHERE id = 1");
                        if($R['FRA']==1){
                            FR_TAL("Pic Name & Link Update Done","success");
                        }else{
                            FR_TAL("Pic Name & Link Update Failed","error");
                        }
                        
                 }else{
                    echo "<div class='alert alert-danger alertt TAC'> Imgae 1 Store Failed </div>"; 
                 }
            }else{
                echo "<div class='alert alert-danger alertt TAC'> Imgae Uploder Not Run </div>"; 
             }
        }
        //////////////// images-1 Proses End ///////////////
    
}
    
    
    
    
    
////////////////////////////////////////////////
// SLIDER IMAGE 2 CONFIG
////////////////////////////////////////////////
if(isset($_POST['do_update_slide_pic_2'])){
   $sli_pic_2_link=$_POST['sli_pic_2_link'];
    $pic_1_name=$_FILES['pic1']['name'];

    $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_2_link = '$sli_pic_2_link' WHERE id = 1");
    if($R['FRA']==1){
        FR_TAL("Images 2 Link Update Done","success");
    }else{
        FR_TAL("Images 2 Link Update Failed","error");
    }


        //////////////// images-1 Proses Start ///////////////    
        if(!empty($pic_1_name)){
        $pic_1_name=$_FILES['pic1']['name'];
        $pic_1_tmp_localion=$_FILES['pic1']['tmp_name'];
        $pic_1_size=$_FILES['pic1']['size'];
        //+
        $pic1_wdthheight=getimagesize($pic_1_tmp_localion);
        $pic_1_width=$pic1_wdthheight[0];    
        $pic_1_height=$pic1_wdthheight[1];
        //+    
        $pic_1_extention_explor= explode('.',$pic_1_name);
        $pic_1_extention = strtolower( end($pic_1_extention_explor) );
         $pic_1_store_name = "$FR_NOW_TIME._frd.$pic_1_extention";
        $pic_1_storelocation = "$FR_HDPATH/frd-data/img/sliders/$pic_1_store_name";

        //FRD WIDTH VALIDATION:- 
        if($pic_1_width == 1200 || $pic_1_width == 1800){
            $frd_img_width_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image width should be 1200 px OR 1800 px </div>";  
         }
         //FRD HEIGHT VALIDATION:- 
         if($pic_1_height == 300 || $pic_1_height == 400 || $pic_1_height == 600){
            $frd_img_height_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image height should be 300 px OR 600 px  </div>";  
         }
        //img extention validator
        if($pic_1_extention=='jpg' || $pic_1_extention=='jpeg' || $pic_1_extention=='png'){
            $frd_img_extention_valid='369frd';
        }else{
            echo "<div class='alert alert-danger alertt TAC'> You Can Uplode Only JPG Or PNG Images </div>";  
        }
        //img size validator
        if($pic_1_size>=200000){
            echo "<div class='alert alert-danger alertt TAC'> Maximum 150kb image you can uplode! </div>";
        }else{
             $frd_img_size_valid='369frd';
        } 


        if( isset($frd_img_width_valid) AND isset($frd_img_height_valid) AND isset($frd_img_extention_valid) AND isset($frd_img_size_valid)){

             if( move_uploaded_file($pic_1_tmp_localion,$pic_1_storelocation) ){

                       $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_2 = '$pic_1_store_name' WHERE id = 1");
                        if($R['FRA']==1){
                            FR_TAL("Pic Name & Link Update Done","success");
                        }else{
                            FR_TAL("Pic Name & Link Update Failed","error");
                        }

                 }else{
                    echo "<div class='alert alert-danger alertt TAC'> Imgae Store Failed </div>"; 
                 }
            }else{
                echo "<div class='alert alert-danger alertt TAC'> Imgae Uploder Not Run </div>"; 
             }
        }
        //////////////// images-1 Proses End ///////////////
    
} 
    
    
    
    
    
    
    
////////////////////////////////////////////////
// SLIDER IMAGE 3 CONFIG
////////////////////////////////////////////////
if(isset($_POST['do_update_slide_pic_3'])){
   $sli_pic_3_link=$_POST['sli_pic_3_link'];
    $pic_1_name=$_FILES['pic1']['name'];


    $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_3_link = '$sli_pic_3_link' WHERE id = 1");
    if($R['FRA']==1){
        FR_TAL("Images 3 Link Update Done","success");
    }else{
        FR_TAL("Images 3 Link Update Failed","error");
    }

        //////////////// images-1 Proses Start ///////////////    
        if(!empty($pic_1_name)){
        $pic_1_name=$_FILES['pic1']['name'];
        $pic_1_tmp_localion=$_FILES['pic1']['tmp_name'];
        $pic_1_size=$_FILES['pic1']['size'];
        //+
        $pic1_wdthheight=getimagesize($pic_1_tmp_localion);
        $pic_1_width=$pic1_wdthheight[0];    
        $pic_1_height=$pic1_wdthheight[1];
        //+    
        $pic_1_extention_explor= explode('.',$pic_1_name);
        $pic_1_extention = strtolower( end($pic_1_extention_explor) );
         $pic_1_store_name = "$FR_NOW_TIME._frd.$pic_1_extention";
        $pic_1_storelocation = "$FR_HDPATH/frd-data/img/sliders/$pic_1_store_name";

        //FRD WIDTH VALIDATION:- 
        if($pic_1_width == 1200 || $pic_1_width == 1800){
            $frd_img_width_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image width should be 1200 px OR 1800 px </div>";  
         }
         //FRD HEIGHT VALIDATION:- 
         if($pic_1_height == 300 || $pic_1_height == 400 || $pic_1_height == 600){
            $frd_img_height_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image height should be 300 px OR 600 px  </div>";  
         }
        //img extention validator
        if($pic_1_extention=='jpg' || $pic_1_extention=='jpeg' || $pic_1_extention=='png'){
            $frd_img_extention_valid='369frd';
        }else{
            echo "<div class='alert alert-danger alertt TAC'> You Can Uplode Only JPG Or PNG Images </div>";  
        }
        //img size validator
        if($pic_1_size>=200000){
            echo "<div class='alert alert-danger alertt TAC'> Maximum 150kb image you can uplode! </div>";
        }else{
             $frd_img_size_valid='369frd';
        } 


        if( isset($frd_img_width_valid) AND isset($frd_img_height_valid) AND isset($frd_img_extention_valid) AND isset($frd_img_size_valid)){

             if( move_uploaded_file($pic_1_tmp_localion,$pic_1_storelocation) ){

                        $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_3 = '$pic_1_store_name' WHERE id = 1");
                        if($R['FRA']==1){
                            FR_TAL("Pic Name & Link Update Done","success");
                        }else{
                            FR_TAL("Pic Name & Link Update Failed","error");
                        } 

                 }else{
                    echo "<div class='alert alert-danger alertt TAC'> Imgae  Store Failed </div>"; 
                 }
            }else{
                echo "<div class='alert alert-danger alertt TAC'> Imgae Uploder Not Run </div>"; 
             }
        }
        //////////////// images-1 Proses End ///////////////
    
}  
    
    
    
    
    
    
 ////////////////////////////////////////////////
// SLIDER IMAGE 4 CONFIG
////////////////////////////////////////////////
if(isset($_POST['do_update_slide_pic_4'])){
   $sli_pic_4_link=$_POST['sli_pic_4_link'];
    $pic_1_name=$_FILES['pic1']['name'];


    $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_4_link = '$sli_pic_4_link' WHERE id = 1");
    if($R['FRA']==1){
        FR_TAL("Images 4 Link Update Done","success");
    }else{
        FR_TAL("Images 4 Link Update Failed","error");
    }
    
        //////////////// images-1 Proses Start ///////////////    
        if(!empty($pic_1_name)){
        $pic_1_name=$_FILES['pic1']['name'];
        $pic_1_tmp_localion=$_FILES['pic1']['tmp_name'];
        $pic_1_size=$_FILES['pic1']['size'];
        //+
        $pic1_wdthheight=getimagesize($pic_1_tmp_localion);
        $pic_1_width=$pic1_wdthheight[0];    
        $pic_1_height=$pic1_wdthheight[1];
        //+    
        $pic_1_extention_explor= explode('.',$pic_1_name);
        $pic_1_extention = strtolower( end($pic_1_extention_explor) );
         $pic_1_store_name = "$FR_NOW_TIME._frd.$pic_1_extention";
        $pic_1_storelocation = "$FR_HDPATH/frd-data/img/sliders/$pic_1_store_name";

        //FRD WIDTH VALIDATION:- 
        if($pic_1_width == 1200 || $pic_1_width == 1800){
            $frd_img_width_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image width should be 1200 px OR 1800 px </div>";  
         }
         //FRD HEIGHT VALIDATION:- 
         if($pic_1_height == 300 || $pic_1_height == 400 || $pic_1_height == 600){
            $frd_img_height_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image height should be 300 px OR 600 px  </div>";  
         }
        //img extention validator
        if($pic_1_extention=='jpg' || $pic_1_extention=='jpeg' || $pic_1_extention=='png'){
            $frd_img_extention_valid='369frd';
        }else{
            echo "<div class='alert alert-danger alertt TAC'> You Can Uplode Only JPG Or PNG Images </div>";  
        }
        //img size validator
        if($pic_1_size>=200000){
            echo "<div class='alert alert-danger alertt TAC'> Maximum 150kb image you can uplode! </div>";
        }else{
             $frd_img_size_valid='369frd';
        } 


        if( isset($frd_img_width_valid) AND isset($frd_img_height_valid) AND isset($frd_img_extention_valid) AND isset($frd_img_size_valid)){

             if( move_uploaded_file($pic_1_tmp_localion,$pic_1_storelocation) ){

                        $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_4 = '$pic_1_store_name' WHERE id = 1");
                        if($R['FRA']==1){
                            FR_TAL("Pic Name & Link Update Done","success");
                        }else{
                            FR_TAL("Pic Name & Link Update Failed","error");
                        }

                 }else{
                    echo "<div class='alert alert-danger alertt TAC'> Imgae  Store Failed </div>"; 
                 }
            }else{
                echo "<div class='alert alert-danger alertt TAC'> Imgae Uploder Not Run </div>"; 
             }
        }
        //////////////// images-1 Proses End ///////////////
    
}     
    
    
    
 
    
 ////////////////////////////////////////////////
// SLIDER IMAGE 5 CONFIG
////////////////////////////////////////////////
if(isset($_POST['do_update_slide_pic_5'])){
   $sli_pic_5_link=$_POST['sli_pic_5_link'];
    $pic_1_name=$_FILES['pic1']['name'];


    $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_5_link = '$sli_pic_5_link' WHERE id = 1");
    if($R['FRA']==1){
        FR_TAL("Images 5 Link Update Done","success");
    }else{
        FR_TAL("Images 5 Link Update Failed","error");
    }

        //////////////// images-1 Proses Start ///////////////    
        if(!empty($pic_1_name)){
        $pic_1_name=$_FILES['pic1']['name'];
        $pic_1_tmp_localion=$_FILES['pic1']['tmp_name'];
        $pic_1_size=$_FILES['pic1']['size'];
        //+
        $pic1_wdthheight=getimagesize($pic_1_tmp_localion);
        $pic_1_width=$pic1_wdthheight[0];    
        $pic_1_height=$pic1_wdthheight[1];
        //+    
        $pic_1_extention_explor= explode('.',$pic_1_name);
        $pic_1_extention = strtolower( end($pic_1_extention_explor) );
         $pic_1_store_name = $FR_NOW_TIME."_frd.$pic_1_extention";
        $pic_1_storelocation = "$FR_HDPATH/frd-data/img/sliders/$pic_1_store_name";

        //FRD WIDTH VALIDATION:- 
        if($pic_1_width == 1200 || $pic_1_width == 1800){
            $frd_img_width_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image width should be 1200 px OR 1800 px </div>";  
         }
         //FRD HEIGHT VALIDATION:- 
         if($pic_1_height == 300 || $pic_1_height == 400 || $pic_1_height == 600){
            $frd_img_height_valid='369frd';    
         }else{ 
           echo "<div class='alert alert-danger alertt TAC'> Image height should be 300 px OR 600 px  </div>";  
         }
        //img extention validator
        if($pic_1_extention=='jpg' || $pic_1_extention=='jpeg' || $pic_1_extention=='png'){
            $frd_img_extention_valid='369frd';
        }else{
            echo "<div class='alert alert-danger alertt TAC'> You Can Uplode Only JPG Or PNG Images </div>";  
        }
        //img size validator
        if($pic_1_size>=200000){
            echo "<div class='alert alert-danger alertt TAC'> Maximum 150kb image you can uplode! </div>";
        }else{
             $frd_img_size_valid='369frd';
        } 


        if( isset($frd_img_width_valid) AND isset($frd_img_height_valid) AND isset($frd_img_extention_valid) AND isset($frd_img_size_valid)){

             if( move_uploaded_file($pic_1_tmp_localion,$pic_1_storelocation) ){

                        $R = FR_DATA_UP("UPDATE frd_sliderr SET pic_5 = '$pic_1_store_name' WHERE id = 1");
                        if($R['FRA']==1){
                            FR_TAL("Pic Name & Link Update Done","success");
                        }else{
                            FR_TAL("Pic Name & Link Update Failed","error");
                        }

                 }else{
                    echo "<div class='alert alert-danger alertt TAC'> Imgae  Store Failed </div>"; 
                 }
            }else{
                echo "<div class='alert alert-danger alertt TAC'> Imgae Uploder Not Run </div>"; 
             }
        }
        //////////////// images-1 Proses End ///////////////
    
}    
    
    
    
    
    
//## slider table dada fetch    
$q_frd="SELECT * from frd_sliderr where id=1";
require("$rtd_path/1_frd.php");   
require("$rtd_path/slider_t_frd.php");      
?>   
</section>
<!-- 1script e-->    

   

   
<sectionn>
   <div class="container">
       <div class="row">
           <div class="col-md-11">
              
               <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                   <img src="<?php echo "$sli_pic_1_url";?>" alt="" class="img-responsive" style="width:100%;height:300px;">
                   
                   <br>
                   <small>Change Slider Image 1 Link </small>
                   <input class="form-control" type="text" name="sli_pic_1_link" value="<?php echo "$sli_pic_1_link";?>" placeholder="Input URL">
                   
                   <div class="row">
                       <div class="col-md-6">
                           <small>Change Slider Image 1 *</small>
                           <input class="form-control" type="file"  name="pic1">
                       </div>
                       <div class="col-md-6 text-right">
                            <br>
                           <input class="btn btn-danger" type="submit" name="do_update_slide_pic_1" value="Confirm & Update" >
                       </div>
                   </div>
               </form>
               
               
               
               
               <br><br><br>
               <br><br><br>
               <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                   <img src="<?php echo "$sli_pic_2_url";?>" alt="" class="img-responsive" style="width:100%;height:300px;">
                   
                   <br>
                   <small>Change Slider Image 2 Link </small>
                   <input class="form-control" type="text" name="sli_pic_2_link" value="<?php echo "$sli_pic_2_link";?>" placeholder="Input URL">
                   
                   <div class="row">
                       <div class="col-md-6">
                           <small>Change Slider Image 2 *</small>
                           <input class="form-control"type="file"  name="pic1" >
                       </div>
                       <div class="col-md-6 text-right">
                           <br>
                           <input class="btn btn-danger" type="submit" name="do_update_slide_pic_2" value="Confirm & Update" >
                       </div>
                   </div>
               </form>
               
               
               
               
               <br><br><br>
               <br><br><br>
               <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                   <img src="<?php echo "$sli_pic_3_url";?>" alt="" class="img-responsive" style="width:100%;height:300px;">
                   
                   <br>
                   <small>Change Slider Image 3 Link </small>
                   <input class="form-control" type="text" name="sli_pic_3_link" value="<?php echo "$sli_pic_3_link";?>" placeholder="Input URL">
                   
                   <div class="row">
                       <div class="col-md-6">
                           <small>Change Slider Image 3 *</small>
                           <input class="form-control" type="file"  name="pic1" >
                       </div>
                       <div class="col-md-6 text-right">
                             <br>
                           <input class="btn btn-primary" type="submit" name="do_update_slide_pic_3" value="Confirm & Update" >
                       </div>
                   </div>
               </form>
               
               
               
               
               
               
               <br><br><br>
               <br><br><br>
               <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                   <img src="<?php echo "$sli_pic_4_url";?>" alt="" class="img-responsive" style="width:100%;height:300px;">
                   
                   <br>
                   <small>Change Slider Image 4 Link </small>
                   <input class="form-control" type="text" name="sli_pic_4_link" value="<?php echo "$sli_pic_4_link";?>" placeholder="Input URL">
                   
                   <div class="row">
                       <div class="col-md-6">
                           <small>Change Slider Image 4 *</small>
                           <input class="form-control" type="file"  name="pic1" >
                       </div>
                       <div class="col-md-6 text-right">
                           <br>
                           <input class="btn btn-primary" type="submit" name="do_update_slide_pic_4" value="Confirm & Update" >
                       </div>
                   </div>
               </form>
               
               
               
               
               
                <br><br><br>
               <br><br><br>
               <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                   <img src="<?php echo "$sli_pic_5_url";?>" alt="" class="img-responsive" style="width:100%;height:300px;">
                   
                   <small>Change Slider Image 5 Link </small>
                   <input class="form-control" type="text" name="sli_pic_5_link" value="<?php echo "$sli_pic_5_link";?>" placeholder="Input URL">
                   
                   <div class="row">
                       <div class="col-md-6">
                           <small>Change Slider Image 5 *</small>
                           <input class="form-control" type="file"  name="pic1" >
                       </div>
                       <div class="col-md-6 text-right">
                           <br>
                           <input class="btn btn-success" type="submit" name="do_update_slide_pic_5" value="Confirm & Update" >
                       </div>
                   </div>
               </form>
               
               
               
               
               
            
           </div>
       </div>
   </div> 
</sectionn>

   







<?php require_once('frd1_footer.php'); ?>