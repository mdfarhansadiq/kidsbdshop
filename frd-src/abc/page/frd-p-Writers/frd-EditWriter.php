<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Edit Writers";//PAGE TITLE
$p="writers";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Edit Writers </h2>

<!-- 1 SCRIPT START -->
<section>
    <?php

    //FRD_VC____________________________________:-
    if (!isset($FRurl[1]) or $FRurl[1] == "") {
        header("location:$FR_THISHURL/dashboard/?FRH=gsgsrbxas3x");
    }
    $FRc_WriterId = $FRurl[1]; //WRITER ID
    $FR_THIS_PAGE = "$FR_THISHURL/writer-EditWriter/$FRc_WriterId";



//FRD IMAGE STOR TYPE CONFIGER:-
if(!isset($_SESSION['FRs_Img_StoreType'])){ $_SESSION['FRs_Img_StoreType'] = "move"; }
if(isset($_POST['f_Img_StoreType'])){ $_SESSION['FRs_Img_StoreType'] = $_POST['f_Img_StoreType']; }




//---------------------------------------------------------
//FRD  UPDATE WRITER:-
//---------------------------------------------------------
if(isset($_POST['f_writer_name'])){

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	
    //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $keys = array_keys($_POST);
        foreach($keys as $key){
            $$key = $_POST["$key"];
            //echo "$key <br>";
        }
    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($f_writer_name)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($f_writer_name != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }


    //FRD CUSTOME DATA MAKE:-
        $FRc_writer_slug = strtolower("$f_writer_slug");
        $FRc_writer_slug = preg_replace("/ /","-",$FRc_writer_slug);



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){

            $FRQ = "UPDATE frd_writers SET 
            fr_writer_name = '$f_writer_name',
            fr_writer_slug = '$FRc_writer_slug',
            fr_writer_details = '$f_writer_details'
            WHERE id = $FRc_WriterId";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL(" $UsrName Write Update Done ","","success");
            }else{
                FR_SWAL(" $UsrName Writer Update Failed","","error");
                FR_GO("$FR_THIS_PAGE","3");
                exit;
            }
        }
    

}
//END>>




if(!empty($_FILES['FRD_IMG_1']['name'])){
  
    //FRD VC NEED:-
        $FR_VC_IMG_EXTENTION = "";
        $FR_VC_IMG_MAX_SIZE = "";
        $FR_VC_IMG_STORE_DONE = "";
        $FR_VC_IMG_WIDTH_HEIGHT = "";
		
		
    //FRD UPLODE IMG CONFIG:-
        $FRc_Img_Quality = 50;
        $FRc_Img_MaxSize_KB = 100000;
        $FRc_Img_MaxSize_Dis = "100 kb";
        if($_SESSION['FRs_Img_StoreType'] == "create"){
             $FRc_Img_StoreType = "create";
        }else{
            $FRc_Img_StoreType = "move";
        }
        
        
        $FRc_Img_Name = $_FILES['FRD_IMG_1']['name'];
        $FRc_Img_Templocalion = $_FILES['FRD_IMG_1']['tmp_name'];
        $FRc_Img_Size = $_FILES['FRD_IMG_1']['size'];//BYTE FORMET
        $FRc_Img_Size_kbf = round($FRc_Img_Size/1000);//KB FORMET
        //+
        $FRc_Img_ExtentionExplor = explode('.',$FRc_Img_Name);
        $FRc_Img_Extention = strtolower( end($FRc_Img_ExtentionExplor) );
        //+
        $FRc_Img_WidthHeight = getimagesize($FRc_Img_Templocalion);
        $FRc_Img_Width = $FRc_Img_WidthHeight[0];    
        $FRc_Img_Height = $FRc_Img_WidthHeight[1];
        //+ 
         $FRc_Img_StoreName = "frd_$FRc_WriterId-$FR_NOW_TIME".".$FRc_Img_Extention";
         $FRc_Img_StoreLocation = "$FR_PATH_HD"."frd-data/img/Writers/$FRc_Img_StoreName";
  
        //img extention validator:-
        if($FRc_Img_Extention =='jpg' || $FRc_Img_Extention =='jpeg'){
            $FR_VC_IMG_EXTENTION = 1;
        }else{
            FR_SWAL("Hi $UsrName","You Can Upload Only JPG Images","error");
            goto LAST_THIS_IMG;
        }
        //img size validator:-
        if($FRc_Img_Size > $FRc_Img_MaxSize_KB){
            FR_SWAL("Hi $UsrName","Maximum $FRc_Img_MaxSize_Dis image you can uplode!","error");
        }else{
            $FR_VC_IMG_MAX_SIZE = 1;
        } 

       
  
        if($FRc_Img_StoreType == "move"){
              //FRD_VC____________________ IMG WIDTH & HIDTH:-
                    if($FRc_Img_Height == 400 && $FRc_Img_Width == 400){
                        $FR_VC_IMG_WIDTH_HEIGHT = 1;
                    }else{
                        FR_SWAL("Hi $UsrName","IMG WIDTH & HEIGHT NEED 400PX x 400PX ($FRc_Img_Height x $FRc_Img_Width)","error");
                    }

            //FRD IMAGE STORE START :--
                if($FR_VC_IMG_EXTENTION == 1 and $FR_VC_IMG_MAX_SIZE == 1 and $FR_VC_IMG_WIDTH_HEIGHT == 1){
                        if( move_uploaded_file($FRc_Img_Templocalion,$FRc_Img_StoreLocation) == 1){
                            $FR_VC_IMG_STORE_DONE = 1;
                        }else{
                           FR_SWAL("ERROR","Image Move Failed","error");
                        }
            
                }
            //END>>>
        }

        //FRD IMAGE CREATE START:-
            elseif($FRc_Img_StoreType == "create"){
                $FRc_Img_AspectRatio = ( $FRc_Img_Width / $FRc_Img_Height );
                $FRc_Img_NewHeight = 400;
                $FRc_Img_NewWidth = round( $FRc_Img_NewHeight * $FRc_Img_AspectRatio );

                $FRc_Img_Create = imagecreatefromjpeg($FRc_Img_Templocalion);
                $FRc_Img_Resize = imagescale($FRc_Img_Create,$FRc_Img_NewWidth,$FRc_Img_NewHeight);

                if( imagejpeg($FRc_Img_Resize,$FRc_Img_StoreLocation,$FRc_Img_Quality) == 1){
                    $FR_VC_IMG_STORE_DONE = 1;
                }else{
                FR_SWAL("ERROR","Image Create Failed","error");
                }

                imagedestroy($FRc_Img_Create);
                imagedestroy($FRc_Img_Resize);
            }
        //END>>
  
        

        //FRD IMAGE STORE NAME SAVE IN DB:-
           if($FR_VC_IMG_STORE_DONE == 1){
                $FRQ = "UPDATE frd_writers SET fr_writer_pic = '$FRc_Img_StoreName' WHERE id = $FRc_WriterId";
                $R = FR_DATA_UP("$FRQ");
                if($R['FRA']==1){
                    FR_SWAL("Hi $UsrName","Image Update [$FRc_Img_StoreType] Done","success");
                }else{
                    FR_SWAL("Hi $UsrName","Image Update [$FRc_Img_StoreType] Failed","error");
                }
           }
        //END>>

   
}


LAST_THIS_IMG:




//FRD WRITER TABLE  READ :-
$FRR = FR_QSEL("SELECT * FROM frd_writers WHERE id = $FRc_WriterId","");
if($FRR['FRA']==1){ 
        extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }
//END>>

    ?>
</section>
<!-- 1 SCRIPT END -->









<section>
    <div class="container">
    <div class="col-md-11">
    
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">



                <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                       <img id="EditwonProfile" src="<?php echo "$FRD_HURL/frd-data/img/writers/$fr_writer_pic"; ?>" alt="User Pic" width="100px" height="auto" class="img-circle"> 
                    </div>
                    
                    <br>
                    <span>Writer Picture * (400px X 400px)</span>
                    <input type="file" name="FRD_IMG_1">

                        <br>
                        <select class='form-control' name='f_Img_StoreType' id='' required>
                            <?php
                            if($_SESSION['FRs_Img_StoreType'] == "create"){
                                echo "<option value='create'>Picture Uplode Type (Create: Auto Compress Upload)</option>";
                            }
                            elseif($_SESSION['FRs_Img_StoreType'] == "move"){
                                echo "<option value='move'>Picture Uplode Type  (Move: Default Upload)</option>";
                            }

                            echo "<option value='move'>Picture Uplode Type  (Move: Default Upload)</option>";
                            echo "<option value='create'>Picture Uplode Type (Create: Auto Compress Upload)</option>";
                            ?>
                        </select>

                    <br>
                    <span>Writer Name *</span>
                    <input class="form-control" type="text" placeholder="Writer Name *" name="f_writer_name" value="<?php echo "$fr_writer_name"; ?>" required>

                    <br>
                    <span>Writer Slug *</span>
                    <input class="form-control" type="text" placeholder="Slug *" name="f_writer_slug" value="<?php echo "$fr_writer_slug"; ?>" required>

                    <br>
                    <span>About Writer </span>
                    <textarea class="form-control" name="f_writer_details" id="summernote"  placeholder="Product description *"><?php echo "$fr_writer_details"?></textarea>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit" name="UserInfoUpdate_SUB"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>




            </div>
            <div class="col-md-2"></div>
        </div>


    </div>
    </div>
</section>


<?php require_once('frd1_footer.php'); ?>   