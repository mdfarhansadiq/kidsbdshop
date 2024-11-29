<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Logo & Icon";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Logo & Icon </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

if(isset($_FILES['FRD_IMG'])){
    //PR($_FILES['FRD_IMG']);
  
    //FRD VC NEED:-
        $FR_VC_IMG_EXTENTION = "";
        $FR_VC_IMG_MAX_SIZE = "";
        $FR_VC_IMG_STORE_DONE = "";
        $FR_VC_IMG_WIDTH = "";
        $FR_VC_IMG_HEIGHT = "";

    //FRD UPLODE IMG CONFIG:-
        $FRc_Img_Quality = 50;
        $FRc_Img_MaxSize_KB = 50000;
        $FRc_Img_MaxSize_Dis = "50kb";
        $FRc_Img_StoreType = "move";
        
        $FRc_Img_Name = $_FILES['FRD_IMG']['name'];
        $FRc_Img_Templocalion = $_FILES['FRD_IMG']['tmp_name'];
        $FRc_Img_Size = $_FILES['FRD_IMG']['size'];//BYTE FORMET
        $FRc_Img_Size_kbf = round($FRc_Img_Size/1000);//KB FORMET
        //+
        $FRc_Img_ExtentionExplor = explode('.',$FRc_Img_Name);
        $FRc_Img_Extention = strtolower( end($FRc_Img_ExtentionExplor) );
        //+
        $FRc_Img_WidthHeight = getimagesize($FRc_Img_Templocalion);
        $FRc_Img_Width = $FRc_Img_WidthHeight[0];    
        $FRc_Img_Height = $FRc_Img_WidthHeight[1];
        //+ 
         $FRc_Img_StoreName = "$FR_NOW_TIME".""."_frd".".$FRc_Img_Extention";
         $FRc_Img_StoreLocation = "$FR_PATH_HD"."frd-data/img/brandlogu/$FRc_Img_StoreName";
  
        //img extention validator:-
        if($FRc_Img_Extention =='jpg' || $FRc_Img_Extention == 'png' || $FRc_Img_Extention == 'gif'){
            $FR_VC_IMG_EXTENTION = 1;
        }else{
            FR_SWAL("Hi $UsrName","You Can Upload Only JPG Or PNG Or Gif Images","error");
            goto LAST_THIS_IMG;
        }
        //img size validator:-
        if($FRc_Img_Size > $FRc_Img_MaxSize_KB){
            FR_SWAL("Hi $UsrName","Maximum $FRc_Img_MaxSize_Dis image you can uplode!","error");
        }else{
            $FR_VC_IMG_MAX_SIZE = 1;
        } 
        //FRD_VC____________________ IMG WIDTH:-
        if($FRc_Img_Width == 200){
            $FR_VC_IMG_WIDTH = 1;
        }else{  
            FR_SWAL("Hi $UsrName","IMG WIDTH NEED 200 PX ($FRc_Img_Width)","error");
        }
        //FRD_VC____________________ IMG HIDTH:-
        if($FRc_Img_Height == 100){
            $FR_VC_IMG_HEIGHT = 1;
        }else{  
            FR_SWAL("Hi $UsrName","IMG HEIGHT NEED 100 PX ($FRc_Img_Height)","error");
        }
  
  
  
  
        //FRD IMAGE STORE START :--
            if($FR_VC_IMG_EXTENTION == 1 and $FR_VC_IMG_MAX_SIZE == 1 and $FR_VC_IMG_WIDTH == 1 and $FR_VC_IMG_HEIGHT == 1){
  
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
                $FRQ = "UPDATE frd_cprofile SET fr_clogo = '$FRc_Img_StoreName' WHERE id = 1";
                $R = FR_DATA_UP("$FRQ");
                if($R['FRA']==1){
                    FR_SWAL("Hi $UsrName","Logo Update [$FRc_Img_StoreType] Done","success");
                    FR_GO("$FR_THIS_PAGE","1");
                     exit;
                }else{
                    FR_SWAL("Hi $UsrName","Logo Update [$FRc_Img_StoreType] Failed","error");
                }
           }
        //END>>
  
   
 }




if(isset($_FILES['FRD_IMG_1'])){
    //PR($_FILES['FRD_IMG']);
  
    //FRD VC NEED:-
        $FR_VC_IMG_EXTENTION = "";
        $FR_VC_IMG_MAX_SIZE = "";
        $FR_VC_IMG_STORE_DONE = "";
        $FR_VC_IMG_WIDTH = "";
        $FR_VC_IMG_HEIGHT = "";

    //FRD UPLODE IMG CONFIG:-
        $FRc_Img_Quality = 50;
        $FRc_Img_MaxSize_KB = 50000;
        $FRc_Img_MaxSize_Dis = "50kb";
        $FRc_Img_StoreType = "move";
        
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
         $FRc_Img_StoreName = "$FR_NOW_TIME".""."_frd".".$FRc_Img_Extention";
         $FRc_Img_StoreLocation = "$FR_PATH_HD"."frd-data/img/brandlogu/$FRc_Img_StoreName";
  
        //img extention validator:-
        if($FRc_Img_Extention =='jpg' || $FRc_Img_Extention == 'png'){
            $FR_VC_IMG_EXTENTION = 1;
        }else{
            FR_SWAL("Hi $UsrName","You Can Upload Only JPG Or PNG Or Gif Images","error");
            goto LAST_THIS_IMG;
        }
        //img size validator:-
        if($FRc_Img_Size > $FRc_Img_MaxSize_KB){
            FR_SWAL("Hi $UsrName","Maximum $FRc_Img_MaxSize_Dis image you can uplode!","error");
        }else{
            $FR_VC_IMG_MAX_SIZE = 1;
        } 
        //FRD_VC____________________ IMG WIDTH:-
        if($FRc_Img_Width == 96){
            $FR_VC_IMG_WIDTH = 1;
        }else{  
            FR_SWAL("Hi $UsrName","IMG WIDTH NEED 96 PX ($FRc_Img_Width)","error");
        }
        //FRD_VC____________________ IMG HIDTH:-
        if($FRc_Img_Height == 96){
            $FR_VC_IMG_HEIGHT = 1;
        }else{  
            FR_SWAL("Hi $UsrName","IMG HEIGHT NEED 96 PX ($FRc_Img_Height)","error");
        }
  
  
  
  
        //FRD IMAGE STORE START :--
            if($FR_VC_IMG_EXTENTION == 1 and $FR_VC_IMG_MAX_SIZE == 1 and $FR_VC_IMG_WIDTH == 1 and $FR_VC_IMG_HEIGHT == 1){
  
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
                $FRQ = "UPDATE frd_cprofile SET fr_cicon = '$FRc_Img_StoreName' WHERE id = 1";
                $R = FR_DATA_UP("$FRQ");
                if($R['FRA']==1){
                    FR_SWAL("Hi $UsrName","iCON Update [$FRc_Img_StoreType] Done","success");
                    FR_GO("$FR_THIS_PAGE","1");
                    exit;
                }else{
                    FR_SWAL("Hi $UsrName","iCON Update [$FRc_Img_StoreType] Failed","error");
                }
           }
        //END>>
  
        
   
 }
 LAST_THIS_IMG:










 
//---------------------------------------------------------
//FRD COMPANY TABLE DATA UPDATE:-
//---------------------------------------------------------
if(isset($_POST['frf_CompanyName'])){

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
        if(isset($frf_CompanyName)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($frf_CompanyName != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; FR_SWAL("Please Fill All Required Field","","error"); }
        

        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){
            $FRQ = "UPDATE frd_cprofile SET 
            fr_cname = '$frf_CompanyName',
            fr_cemail_1 = '$frf_CompanyEmail_1',
            fr_cemail_2 = '$frf_CompanyEmail_2',
            fr_cmobile_1 = '$frf_CompanyMobile_1',
            fr_cmobile_2 = '$frf_CompanyMobile_2',
            fr_caddress_1 = '$frf_Address_1',
            fr_caddress_2 = '$frf_Address_2',
            fr_ctagline = '$fr_ctagline',
            dumytxt = '$FR_NOW_TIME'
            WHERE id = 1";
            $R = FR_DATA_UP("$FRQ");
            //PR($R);
            if($R['FRA']==1){
                FR_SWAL("$UsrName তথ্য আপডেট হয়েছে ","","success");
                FR_GO("$FR_THIS_PAGE","3");
                exit;
            }else{
                FR_SWAL("$UsrName তথ্য আপডেট হয়নি ","","error");
                FR_GO("$FR_THIS_PAGE","1");
                exit;
            }
        }
    

}
//END>>
?>   
</section>
<!-- 1 SCRIPT END -->    

   

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                    <img id="" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="" class="img-responsive"> <br>
                    <span>Company Logo *</span>
                    <input class="form-control" type="file" name="FRD_IMG" required>
                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

                <form class="jumbotron" id="" action="" method="post" enctype="multipart/form-data">
                    <img id="" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_cicon"; ?>" alt="" class="img-responsive" width="50px"> <br>
                    <span>Company Icon *</span>
                    <input class="form-control" type="file" name="FRD_IMG_1" required>
                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>



<?php if(isset($_GET['iamfrd'])){ ?>
<br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form class="jumbotron" id="" action="" method="post">
                   <h2 class="text-center boldd">Bio Data</h2>

                    <span>Company Name *</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="frf_CompanyName" value="<?php echo "$fr_cname";?>" required>

                    <br>
                    <span>Company Mobile Number 1*</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="frf_CompanyMobile_1" value="<?php echo "$fr_cmobile_1";?>" required>

                    <br>
                    <span>Company Mobile Number 2*</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="frf_CompanyMobile_2" value="<?php echo "$fr_cmobile_2";?>">

                    <br>
                    <span>Company Email Address 1*</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="frf_CompanyEmail_1" value="<?php echo "$fr_cemail_1";?>" required>

                    <br>
                    <span>Company Email Address 2*</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="frf_CompanyEmail_2" value="<?php echo "$fr_cemail_2";?>">

                    <br>
                    <span> Address 1 *</span>
                    <textarea class="form-control" name="frf_Address_1" id="" cols="30" rows="4" placeholder="লিখুন" required><?php echo "$fr_caddress_1";?></textarea>

                    <br>
                    <span> Address 2 *</span>
                    <textarea class="form-control" name="frf_Address_2" id="" cols="30" rows="4" placeholder="লিখুন"><?php echo "$fr_caddress_2";?></textarea>

                    <br>
                    <span>Company Tagline *</span>
                    <input class="form-control" type="text" placeholder="লিখুন *" name="fr_ctagline" value="<?php echo "$fr_ctagline";?>" required>

                    <br>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-save"></span> Save </button>
                    </div>
                </form>

               
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<?php } ?>






<?php require_once('frd1_footer.php'); ?>   