<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "My Profile - $fr_cname";
$FRc_META_TAG_HTML = "";
require_once("frd-this-header.php");
require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT"> MY PROFILE </h2>-->
<!-- 1 scripts s-->
<section>
<?php


//FRD USER PROFILE DATA:-
    $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE id = ".$_SESSION['s_cust_id']."","");
    if($FRR['FRA']==1){ 
       extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }
//END>>




//---------------------------------------------------------
//FRD USER DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['frf_UserName'])){

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
        if(isset($frf_UserName)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($frf_UserName != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }

          //email1 = '$frf_UseLUN',

        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRc_uniqid = uniqid();
            $FRQ = "UPDATE frd_usr SET 
            namee = '$frf_UserName',
            addresss = '$frf_address',
            genderr = '$frf_gender',
            bkash_num = '$frf_bkash_number',
            nagad_num = '$frf_nagad_number',
            psw_rc = '$FRc_uniqid'
            WHERE id = $cust_id";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                $cust_name = $_SESSION['s_cust_Name'] = "$frf_UserName";
                FR_SWAL("$cust_name তথ্য আপডেট হয়েছে ","","success");
                FR_GO("$FR_THISPAGE","2");
            }else{
                FR_SWAL(" $cust_name তথ্য আপডেট হয়নি ","","error");
                FR_GO("$FR_THISPAGE","2");
                exit;
            }
        }
    

}
//END>> 



//FRD PROFILE IMAGE UPLODE:-
    if(!empty($_FILES['FRD_IMG']['name'])){
        //PR($_FILES['FRD_IMG']);
    
        //FRD VC NEED:-
            $FR_VC_IMG_EXTENTION = "";
            $FR_VC_IMG_MAX_SIZE = "";
                $FR_VC_IMG_STORE_DONE = "";
        //FRD UPLODE IMG CONFIG:-
            $FRc_Img_Quality = 50;
            $FRc_Img_MaxSize_KB = 900000;
            $FRc_Img_MaxSize_Dis = "900 kb";
            if($FR_SERVER==1){
                 $FRc_Img_StoreType = "create";
            }else{
                 $FRc_Img_StoreType = "move";
            }
            
            
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
            // $FRc_Img_StoreName = "$FR_NOW_YEAR/$FR_NOW_TIME"."_$FRs_UsrId"."_frd".".$FRc_Img_Extention";
            $FRc_Img_StoreName = "$FR_NOW_TIME"."_$cust_id"."_frd".".$FRc_Img_Extention";
            $FRc_Img_StoreLocation = "$FR_PATH_HD"."frd-data/img/customer/$FRc_Img_StoreName";
    
            //img extention validator:-
            if($FRc_Img_Extention =='jpg' || $FRc_Img_Extention == 'jpeg'){
                $FR_VC_IMG_EXTENTION = 1;
            }else{
                FR_SWAL("Hi $FRs_UsrName","You Can Upload Only JPG Images","error");
                goto LAST_THIS_IMG;
            }
            //img size validator:-
            if($FRc_Img_Size > $FRc_Img_MaxSize_KB){
                FR_SWAL("Hi $FRs_UsrName","Maximum $FRc_Img_MaxSize_Dis image you can uplode!","error");
            }else{
                $FR_VC_IMG_MAX_SIZE = 1;
            } 
    
    
    
    
            //FRD IMAGE STORE START :--
                if($FR_VC_IMG_EXTENTION == 1 and $FR_VC_IMG_MAX_SIZE == 1){
    
                    //FRD IMG CREAT:-
                    if($FRc_Img_StoreType == "create"){
                        
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
                    
                    //FRD IMG MOVE:-
                    if($FRc_Img_StoreType == "move"){
                        if( move_uploaded_file($FRc_Img_Templocalion,$FRc_Img_StoreLocation) == 1){
                            $FR_VC_IMG_STORE_DONE = 1;
                        }else{
                        FR_SWAL("ERROR","Image Store Failed","error");
                        }
                    }
                    
    
                    
                }
            //END>>>
    
    
            //FRD IMAGE STORE NAME SAVE IN DB:-
            if($FR_VC_IMG_STORE_DONE == 1){
                    $FRQ = "UPDATE frd_usr SET picc='$FRc_Img_StoreName' WHERE id = $cust_id";
                    $R = FR_DATA_UP("$FRQ");
                    if($R['FRA']==1){
                        FR_SWAL("Hi $cust_name","Image Update [$FRc_Img_StoreType] Done","success");
                    }else{
                        FR_SWAL("Hi $cust_name","Image Update [$FRc_Img_StoreType] Failed","error");
                    }
            }
            //END>>
    
            LAST_THIS_IMG:
    
    }


?>
</section>
<!-- 1 scripts e-->

   

<section>
    <div class="container">
        <div class="col-md-11">
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">

                    <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                        <div class="text-center">
                            <img src="<?php echo "$FRD_HURL/frd-data/img/customer/$picc";?>" style='max-height:100px;width:auto;' class="img-circle" alt="">
                        </div>
                        <span>প্রোফাইল ছবি </span><br>
                        <input  class="form-control" type="file"  name="FRD_IMG">

                        <br>
                        <span>সম্পূর্ণ নাম *</span>
                        <input  class="form-control" type="text" placeholder="লিখুন " name="frf_UserName" value="<?php echo "$namee";?>" required>

                        <br>
                        <span>মোবাইল নাম্বার *</span>
                        <input class="form-control" type="text" placeholder="লিখুন" name="frf_UseLUN" value="<?php echo "$email1";?>" disabled required >
                        

                        <br>
                        <span> ঠিকানা *</span>
                        <textarea class="form-control" name="frf_address" id="" rows="3" placeholder="লিখুন" required><?php echo "$addresss";?></textarea>


                        <br>
                        <table width="100%">
                            <tr>
                                <td>
                                   <span> জেন্ডার *</span>
                                </td>
                                <td>
                                   <input type="radio" name="frf_gender" value="1" required <?php if($genderr == 1){ echo "checked"; }?> > পুরুষ <br>
                                   <input type="radio" name="frf_gender" value="2" required <?php if($genderr == 2){ echo "checked"; }?> > মহিলা <br> 
                                </td>
                            </tr>
                        </table>


                        <br>
                        <span>বিকাশ নাম্বার</span>
                        <input class="form-control" type="number" placeholder="লিখুন" name="frf_bkash_number" value="<?php echo "$bkash_num";?>" >

                        <br>
                        <span>নগদ নাম্বার</span>
                        <input class="form-control" type="number" placeholder="লিখুন" name="frf_nagad_number" value="<?php echo "$nagad_num";?>" >
                        

                        

                                <br>
                                <div class="text-right">
                                    <button class="btn btn-success" type="submit" name="UserInfoUpdate_SUB"> <span class="glyphicon glyphicon-save"></span> নিশ্চিত নিশ্চিত </button>
                                </div>


                

                    </form>

                </div>
                <div class="col-md-3"></div>
            </div>


        </div>
    </div>
</section>








<?php 
require_once("frd-this-footer.php");
require_once("frd-public/theme/frd-footer.php");
?>